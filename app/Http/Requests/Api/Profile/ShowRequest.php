<?php

namespace App\Http\Requests\Api\Profile;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ProfileResource;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
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
            return $this->apiResponse(new ProfileResource($user), 200, __('messages.profile.show'));
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
}
