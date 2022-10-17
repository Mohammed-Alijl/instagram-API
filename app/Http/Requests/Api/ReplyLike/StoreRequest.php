<?php

namespace App\Http\Requests\Api\ReplyLike;

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
            $isSetLike = DB::table('reply_likes')->where(['user_id' => auth('user')->id(), 'reply_id' => $this->reply_id])->first();
            if ($isSetLike)
                return $this->apiResponse(null, 422, __('messages.reply.like.exists'));
            $like = DB::table('reply_likes')->insert(['reply_id' => $this->reply_id, 'user_id' => auth('user')->id()]);
            return $this->apiResponse($like, 201, __('messages.reply.like.add'));
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
            'reply_id' => 'required|numeric|exists:replies,id'
        ];
    }

    public function messages()
    {
        return [
            'reply_id.required' => __('messages.reply.reply_id.required'),
            'reply_id.numeric' => __('messages.reply.reply_id.numeric'),
            'reply_id.exists' => __('messages.reply.reply_id.exists')
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
