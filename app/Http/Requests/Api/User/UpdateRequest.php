<?php

namespace App\Http\Requests\Api\User;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\UserResource;
use App\Traits\ImageTrait;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    use Api_Response, ImageTrait;

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
            $user = auth('user')->user();
            if ($this->filled('nick_name'))
                $user->nick_name = $this->nick_name;
            if ($this->filled('bio'))
                $user->bio = $this->bio;
            if ($this->filled('date_of_birth'))
                $user->date_of_birth = $this->date_of_birth;
            if ($user->save())
                return $this->apiResponse(new UserResource($user), 200, __('messages.user.update'));
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
            'bio' => 'string|max:255',
            'nick_name' => 'string|max:255',
            'date_of_birth' => 'date_format:d/m/Y|max:255',
        ];
    }

    public function messages()
    {
        return [
            'bio.string' => __('messages.user.bio.string'),
            'bio.max' => __('messages.user.bio.max'),
            'nick_name.string' => __('messages.user.nick_name.string'),
            'nick_name.max' => __('messages.user.nick_name.max'),
            'date_of_birth.date_format' => __('messages.user.date_of_birth.date_format'),
            'date_of_birth.max' => __('messages.user.date_of_birth.max'),
        ];
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }
}
