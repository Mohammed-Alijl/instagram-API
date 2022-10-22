<?php

namespace App\Http\Requests\Api\Story;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Story;
use App\Traits\ImageTrait;
use App\Traits\VideoTrait;
use Illuminate\Foundation\Http\FormRequest;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class DestroyRequest extends FormRequest
{
    use Api_Response,ImageTrait, VideoTrait;

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
            $story = Story::find($id);
            if(!$story)
                return $this->apiResponse(null,404,__('messages.story.notFound'));
            $this->isImage($story->media) ? $this->delete_image('img/stories/' . $story->media) : $this->delete_video('video/stories/' . $story->media);
            if($story->delete())
                return $this->apiResponse(null,200,__('messages.story.destroy'));
            return $this->apiResponse(null,500,__('messages.failed'));
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
