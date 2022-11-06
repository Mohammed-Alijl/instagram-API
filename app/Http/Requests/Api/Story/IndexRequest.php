<?php

namespace App\Http\Requests\Api\Story;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\StoryResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class IndexRequest extends FormRequest
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
            $id = [];
            $followings = auth('user')->user()->follow;
            foreach($followings as $following){
                if($following->stories->count()>0)
                    $id[] = $following->id;
            }
            $users = User::whereIn('id',$id)->get();
            return $this->apiResponse(UserResource::collection($users),200,__('messages.story.index'));

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
