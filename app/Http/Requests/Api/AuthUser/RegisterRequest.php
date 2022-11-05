<?php

namespace App\Http\Requests\Api\AuthUser;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    use Api_Response, ImageTrait;

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
            $user = new User();
            $user->name = $this->name;
            $user->email = $this->email;
            $user->password = bcrypt($this->password);
            $user->bio = $this->bio;
            $user->phone = $this->phone;
            if ($this->filled('nick_name'))
                $user->nick_name = $this->nick_name;
            else
                $user->nick_name = $this->name;
            $user->date_of_birth = $this->date_of_birth;
            if ($image = $this->file('image')) {
                $imageName = $this->save_image($image, "img/users/profile");
                $user->image = $imageName;
            } else
                $user->image = 'default.png';
            if ($user->save()) {
                event(new Registered($user));
                $token = $user->createToken('UserType')->accessToken;
                return $this->apiResponse(['access_token' => $token, 'user' => new UserResource($user)], 201, __('messages.register'));
            }
            return $this->apiResponse(null, 500, __('messages.failed'));
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
            'name' => 'required|string|max:100|unique:users,name|regex:/^[A-Za-z][A-Za-z0-9_]{7,29}$/',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:30',
            'bio' => 'string|max:255',
            'nick_name' => 'string|max:255',
            'date_of_birth' => 'required|date_format:d/m/Y|max:255|before:' . '1/1/' . now()->year - 13,
            'phone' => 'required|min:6|max:15|unique:users,phone',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('messages.authUser.name.required'),
            'name.string' => __('messages.authUser.name.string'),
            'name.max' => __('messages.authUser.name.max'),
            'name.unique' => __('messages.authUser.name.unique'),
            'name.regex'=>__('messages.authUser.name.regex'),
            'email.required' => __('messages.authUser.email.required'),
            'email.email' => __('messages.authUser.email.email'),
            'email.max' => __('messages.authUser.email.max'),
            'email.unique' => __('messages.authUser.email.unique'),
            'password.required' => __('messages.authUser.password.required'),
            'password.string' => __('messages.authUser.password.string'),
            'password.min' => __('messages.authUser.password.min'),
            'password.max' => __('messages.authUser.password.max'),
            'bio.string' => __('messages.authUser.bio.string'),
            'bio.max' => __('messages.authUser.bio.max'),
            'nick_name.string' => __('messages.authUser.nick_name.string'),
            'nick_name.max' => __('messages.authUser.nick_name.max'),
            'date_of_birth.required' => __('messages.authUser.date_of_birth.required'),
            'date_of_birth.date_format' => __('messages.user.date_of_birth.date_format'),
            'date_of_birth.max' => __('messages.user.date_of_birth.max'),
            'date_of_birth.before' => __('messages.user.date_of_birth.underage'),
            'phone.required' => __('messages.authUser.phone.required'),
            'phone.min' => __('messages.authUser.phone.min'),
            'phone.unique' => __('messages.authUser.phone.unique'),
            'phone.max' => __('messages.authUser.phone.max'),
            'image.mimes' => __('messages.authUser.image.mimes'),
            'image.max' => __('messages.authUser.image.max'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }
}
