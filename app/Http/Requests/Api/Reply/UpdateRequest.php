<?php

namespace App\Http\Requests\Api\Reply;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ReplyResource;
use App\Models\Reply;
use Exception;
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
            $reply = Reply::find($id);
            if (!$reply)
                return $this->apiResponse(null, 404, __('messages.reply.notFound'));
            if ($reply->user_id != auth('user')->id())
                return $this->apiResponse(null, 403, __('messages.authorization'));
            $reply->reply = $this->reply;
            if ($reply->save())
                return $this->apiResponse(new ReplyResource($reply), 200, __('messages.reply.update'));
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
            'reply' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'reply.required' => __('messages.reply.reply.required'),
            'reply.string' => __('messages.reply.reply.string'),
            'reply.max' => __('messages.reply.reply.max'),
        ];
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
}
