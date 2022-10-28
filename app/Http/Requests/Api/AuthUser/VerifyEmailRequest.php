<?php

namespace App\Http\Requests\Api\AuthUser;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Http\FormRequest;

class VerifyEmailRequest extends FormRequest
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

    public function run($id){
        try {
            $user = User::find($id);
            if(!$user)
                return $this->apiResponse(null,404,__('messages.user.notFound'));
            if ($user->hasVerifiedEmail())
                return $this->apiResponse(null,422,__('messages.email.verify.before'));

            if ($user->markEmailAsVerified()) {
                event(new Verified($user()));
            }
            return $this->apiResponse(['verify'=>true],200,__('messages.email.verify.true'));
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
            //
        ];
    }
}
