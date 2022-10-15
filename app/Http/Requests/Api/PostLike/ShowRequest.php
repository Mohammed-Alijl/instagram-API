<?php

namespace App\Http\Requests\Api\PostLike;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Post;
use App\Models\PostLike;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

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
            $like = DB::table('likes')->where(['post_id'=>$id,'user_id'=>auth('user')->id()])->first();
            if($like)
                return $this->apiResponse(['like'=>true],200,__('messages.like.like'));
            return $this->apiResponse(['like'=>false],200,__('messages.like.not.like'));
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
        throw new HttpResponseException($this->apiResponse(null,401, __('messages.authorization')));
    }
}
