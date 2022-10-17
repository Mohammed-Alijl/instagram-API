<?php

namespace App\Http\Requests\Api\Reply;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            $reply = new Reply();
            $reply->user_id = auth('user')->id();
            $reply->comment_id = $this->comment_id;
            $reply->reply = $this->reply;
            if ($reply->save())
                return $this->apiResponse(new ReplyResource($reply), 201, __('messages.reply.store'));
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
            'comment_id' => 'required|numeric|exists:comments,id',
            'reply' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'comment_id.required' => __('messages.reply.comment_id.required'),
            'comment_id.numeric' => __('messages.reply.comment_id.numeric'),
            'comment_id.exists' => __('messages.reply.comment_id.exists'),
            'reply.required' => __('messages.reply.reply.required'),
            'reply.string' => __('messages.reply.reply.string'),
            'reply.max' => __('messages.reply.reply.max'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 401, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
}
