<?php

namespace App\Http\Requests\Api\PostSave;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Post;
use App\Models\PostSave;
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
            $post = Post::find($id);
            if (!$post)
                return $this->apiResponse(null, 404, __('messages.post.found'));
            $postSave = DB::table('post_saves')->where(['user_id'=>auth('user')->id(),'post_id'=>$id])->first();
            if(!$postSave)
                return $this->apiResponse(null,422,__('messages.post.save.false'));
            if(DB::table('post_saves')->delete($postSave->id))
                return $this->apiResponse(null,200,__('messages.post.save.delete'));
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
