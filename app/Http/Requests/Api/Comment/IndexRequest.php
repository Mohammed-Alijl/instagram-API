<?php

namespace App\Http\Requests\Api\Comment;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
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

    public function run(){
        try {
            return CommentResource::collection(Comment::where('post_id',$this->post_id)->OrderBy('created_at','desc')->paginate(config('constants.USER_PAGINATION')));

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
        return[
          'post_id.required'=>__('messages.comment.post_id.required'),
          'post_id.numeric'=>__('messages.comment.post_id.numeric'),
          'post_id.exists'=>__('messages.comment.post_id.exists'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null,401,__('messages.authorization')));
    }
}
