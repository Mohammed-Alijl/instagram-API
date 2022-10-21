<?php

namespace App\Http\Requests\Api\User;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\UserResource;
use App\Traits\ImageTrait;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfileImageRequest extends FormRequest
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
            $image = $this->file('image');
                $this->delete_image('img/users/profile/' . $user->image);
                $imageName = $this->save_image($image, "img/users/profile");
                $user->image = $imageName;
            if ($user->save())
                return $this->apiResponse(new UserResource($user), 200, __('messages.user.image.update'));
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
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'image.required' => __('messages.user.image.required'),
            'image.mimes' => __('messages.user.image.mimes'),
            'image.max' => __('messages.user.image.max'),
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
