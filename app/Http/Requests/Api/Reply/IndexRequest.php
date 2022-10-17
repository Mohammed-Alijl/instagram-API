<?php

namespace App\Http\Requests\Api\Reply;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ReplyResource;
use App\Models\Comment;
use App\Models\Reply;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class IndexRequest extends FormRequest
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

    public function run()
    {
        try {
            $comment = Comment::find($this->comment_id);
            if (!$comment)
                return $this->apiResponse(null, 404, __('messages.comment.notFound'));
            return ReplyResource::collection(Reply::where('comment_id', $this->comment_id)->get());
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
