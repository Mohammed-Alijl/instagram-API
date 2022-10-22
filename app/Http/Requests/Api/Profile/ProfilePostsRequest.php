<?php

namespace App\Http\Requests\Api\Profile;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\PostResource;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfilePostsRequest extends FormRequest
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
            if (!$user)
                return $this->apiResponse(null, 404, __('messages.user.notFound'));
            $posts = $user->posts()->orderBy('created_at','desc')->paginate(config('constants.POST_PAGINATION'));
            return PostResource::collection($posts);
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
    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null,401,__('messages.authorization')));
    }
}
