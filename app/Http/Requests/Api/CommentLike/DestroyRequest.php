<?php

namespace App\Http\Requests\Api\CommentLike;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Comment;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class DestroyRequest extends FormRequest
{
    use Api_Response;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('user')->check();
    }

    public function run($id)
    {
        try {
            $comment = Comment::find($id);
            if (!$comment)
                return $this->apiResponse(null, 404, __('messages.comment.notFound'));
            $like = DB::table('comment_likes')->where(['user_id' => auth('user')->id(), 'comment_id' => $id])->first();
            if (!$like)
                return $this->apiResponse(null, 422, __('messages.comment.not.like'));
            if (DB::table('comment_likes')->delete($like->id))
                return $this->apiResponse(null, 200, __('messages.comment.like.destroy'));
            return $this->apiResponse(null, 200, __('messages.failed'));

        } catch (Exception $ex) {
            return $this->apiResponse(null, 500, $ex->getMessage());
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
}
