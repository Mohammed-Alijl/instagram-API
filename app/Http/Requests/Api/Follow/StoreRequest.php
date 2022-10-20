<?php

namespace App\Http\Requests\Api\Follow;

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
            $isFollow = DB::table('user_followers')->where(['user_id' => $this->user_id, 'follower_id' => auth('user')->id()])->first();
            if($isFollow)
                return $this->apiResponse(null,422,__('messages.follow.exists'));
            $follow = DB::table('user_followers')->insert(['user_id' => $this->user_id, 'follower_id' => auth('user')->id()]);
            if ($follow)
                return $this->apiResponse($follow, 200, __('messages.follow.store'));
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
            'user_id' => 'required|numeric|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => __('messages.follow.user_id.required'),
            'user_id.numeric' => __('messages.follow.user_id.numeric'),
            'user_id.exists' => __('messages.follow.user_id.exists'),
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
