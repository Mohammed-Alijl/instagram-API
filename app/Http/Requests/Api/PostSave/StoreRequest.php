<?php

namespace App\Http\Requests\Api\PostSave;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostSave;
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
            $isSave = DB::table('post_saves')->where(['user_id' => auth('user')->id(), 'post_id' => $this->post_id])->first();
            if($isSave)
                return $this->apiResponse(null,422,__('messages.post.save.exists'));
            DB::table('post_saves')->insert(['user_id' => auth('user')->id(), 'post_id' => $this->post_id]);
            return $this->apiResponse(new PostResource(Post::find($this->post_id)), 200, __('messages.post.save.store'));
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
            'post_id' => 'required|numeric|exists:posts,id'
        ];
    }

    public function messages()
    {
        return [
            'post_id.required' => __('messages.post.post_id.required'),
            'post_id.numeric' => __('messages.post.post_id.numeric'),
            'post_id.posts' => __('messages.post.post_id.posts'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(['saved'=>false], 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
}
