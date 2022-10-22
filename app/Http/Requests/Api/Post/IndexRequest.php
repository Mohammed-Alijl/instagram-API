<?php

namespace App\Http\Requests\Api\Post;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\PostResource;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

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
            $posts = auth('user')->user()->followers()->posts();
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
}
