<?php

namespace App\Http\Requests\Api\AuthUser;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class LoginRequest extends FormRequest
{
    use Api_Response;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function run()
    {
        try {
            if ($this->filled('email'))
                $user = User::where('email', $this->email)->first();
            else if ($this->filled('username'))
                $user = User::where('name', $this->username)->first();
            else if ($this->filled('phone'))
                $user = User::where('phone', $this->phone)->first();
            else
                return $this->apiResponse(null, 422, __('messages.login.found'));
            if (Hash::check($this->password, $user->password)) {
                $token = $user->createToken('UserType')->accessToken;
                return $this->apiResponse(['access_token' => $token, 'user' => new UserResource($user)], 200, __('messages.login'));
            } else
                return $this->apiResponse(null, 422, __('messages.password.mismatch'));
        } catch (Exception $exception) {
            return $this->apiResponse(null, 500, $exception->getMessage());
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
            'email' => 'email|exists:users,email',
            'username' => 'string|exists:users,name',
            'phone' => 'string|exists:users,phone',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.email' => __('messages.authUser.email.email'),
            'email.exists' => __('messages.authUser.email.exists'),
            'username.string' => __('messages.authUser.username.string'),
            'username.exists' => __('messages.authUser.username.exists'),
            'phone.string' => __('messages.authUser.phone.string'),
            'phone.exists' => __('messages.authUser.phone.exists'),
            'password.required' => __('messages.authUser.password.required'),
            'password.string' => __('messages.authUser.password.string'),
            'password.min' => __('messages.authUser.password.min'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }
}
