<?php

namespace App\Http\Requests\Api\PostSave;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostSave;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

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
            $posts = auth('user')->user()->postSave()->orderBy('created_at','desc')->paginate(config('constants.POST_PAGINATION'));
            return PostResource::collection($posts);
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
