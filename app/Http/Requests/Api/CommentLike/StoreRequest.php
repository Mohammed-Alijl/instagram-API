<?php

namespace App\Http\Requests\Api\CommentLike;

use App\Http\Controllers\Api\Traits\Api_Response;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class StoreRequest extends FormRequest
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
            $isSetLike = DB::table('comment_likes')->where(['user_id' => auth('user')->id(), 'comment_id' => $this->comment_id])->first();
            if ($isSetLike)
                return $this->apiResponse(null, 422, __('messages.comment.like.exists'));
            $like = DB::table('comment_likes')->insert(['comment_id' => $this->comment_id, 'user_id' => auth('user')->id()]);
            return $this->apiResponse($like, 201, __('messages.comment.like.add'));
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
            'comment_id' => 'required|numeric|exists:comments,id'
        ];
    }

    public function messages()
    {
        return [
            'comment_id.required' => __('messages.comment.comment_id.required'),
            'comment_id.numeric' => __('messages.comment.comment_id.numeric'),
            'comment_id.exists' => __('messages.comment.comment_id.exists')
        ];
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 401,$validator->errors()));
    }
}
