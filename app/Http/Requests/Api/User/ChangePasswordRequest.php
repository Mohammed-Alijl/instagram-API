<?php

namespace App\Http\Requests\Api\User;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
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
            $user = auth('user')->user();
            if (!Hash::check($this->current_password, $user->password))
                return $this->apiResponse(['change'=>false], 422, __('messages.user.current_password.false'));
            $user->password = $this->new_password;
            if ($user->save())
                return $this->apiResponse(['change' => true], 200, __('messages.user.password.change'));
            return $this->apiResponse(['change' => false], 500, __('messages.failed'));
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
            'current_password' => 'required|min:6|max:30',
            'new_password' => 'required|confirmed|min:6|max:30',
        ];
    }

    public function messages()
    {
        return [
            'new_password.required' => __('messages.user.new_password.required'),
            'new_password.confirmed' => __('messages.user.new_password.confirmed'),
            'new_password.min' => __('messages.user.new_password.min'),
            'new_password.max' => __('messages.user.new_password.max'),
            'current_password.required' => __('messages.user.current_password.required'),
            'current_password.min' => __('messages.user.current_password.false'),
            'current_password.max' => __('messages.user.current_password.false'),
        ];
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(['change'=>false], 422, $validator->errors()));
    }
}
