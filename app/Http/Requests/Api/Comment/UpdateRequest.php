<?php

namespace App\Http\Requests\Api\Comment;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
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
            if ($comment->user_id != auth('user')->id())
                return $this->apiResponse(null, 403, __('messages.authorization'));
                $comment->comment = $this->comment;
            if ($comment->save())
                return $this->apiResponse(new CommentResource($comment), 200, __('messages.comment.update'));
            return $this->apiResponse(null, 500, __('messages.failed'));
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
            'comment' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => __('messages.comment.comment.required'),
            'comment.string' => __('messages.comment.comment.string'),
            'comment.max' => __('messages.comment.comment.max'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
}
