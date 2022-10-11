<?php

namespace App\Http\Requests\Api\Post;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

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

    public function run($id){
        try {
            $post = Post::find($id);
            if(!$post)
                return $this->apiResponse(null,404,__('messages.post.found'));
            return $this->apiResponse(new PostResource($post),200,__('messages.post.show'));
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
