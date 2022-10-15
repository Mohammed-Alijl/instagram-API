<?php

namespace App\Http\Requests\Api\PostLike;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\PostLike;
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

    public function run(){
        try {
            if(DB::table('likes')->where(['post_id'=>$this->post_id,'user_id'=>auth('user')->id()])->first())
                return $this->apiResponse(null,422,__('messages.like.exists'));
            $like = DB::table('likes')->insert(['user_id'=>auth('user')->id(),'post_id'=>$this->post_id]);
                return $this->apiResponse($like,200,__('messages.like.store'));
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
            'post_id'=>'required|numeric|exists:posts,id'
        ];
    }
    public function messages()
    {
        return [
          'post_id.required'=>__('messages.like.post_id.required'),
          'post_id.numeric'=>__('messages.like.post_id.numeric'),
          'post_id.exists'=>__('messages.post.found'),
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null,422,$validator->errors()));
    }
    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null,401, __('messages.authorization')));
    }
}
