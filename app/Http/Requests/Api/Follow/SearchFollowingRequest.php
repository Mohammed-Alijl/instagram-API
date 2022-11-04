<?php

namespace App\Http\Requests\Api\Follow;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SearchFollowingRequest extends FormRequest
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

    public function run(){
        try {
            $user = User::find($this->user_id);
            if (!$user)
                return $this->apiResponse(null, 404, __('messages.user.notFound'));
            $following = $user->follow()->where('name', 'like', "%$this->toSearch%")->get();
            return $this->apiResponse(UserResource::collection($following), 200, __('messages.follow.search'));
        }catch (Exception $ex){
            return $this->apiResponse(null,500,$ex->getMessage());
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
            'user_id' => 'required|numeric|exists:users,id',
            'toSearch' => 'required|string'
        ];
    }
    public function messages()
    {
        return [
            'user_id.required' => __('messages.follow.user_id.required'),
            'user_id.numeric' => __('messages.follow.user_id.numeric'),
            'user_id.exists' => __('messages.follow.user_id.exists'),
            'toSearch.required' => __('messages.follow.toSearch.required'),
            'toSearch.string' => __('messages.follow.toSearch.string'),
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
