<?php

namespace App\Http\Requests\Api\Follow;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class DestroyRequest extends FormRequest
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
            $user = User::find($id);
            if (!$user)
                return $this->apiResponse(null, 404, __('messages.user.notFound'));
            $follow = DB::table('user_followers')->where(['user_id' => $id, 'follower_id' => auth('user')->id()])->first();
            if (!$follow)
                return $this->apiResponse(null, 422, __('messages.follow.false'));
            if (DB::table('user_followers')->delete($follow->id))
                return $this->apiResponse(null, 200, __('messages.follow.destroy'));

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
            //
        ];
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
}
