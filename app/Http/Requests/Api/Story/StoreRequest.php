<?php

namespace App\Http\Requests\Api\Story;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\StoryResource;
use App\Models\Story;
use App\Traits\ImageTrait;
use App\Traits\VideoTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
{
    use Api_Response, ImageTrait, VideoTrait;

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
            $story = new Story();
            $story->user_id = auth('user')->id();
            $media = $this->file('media');
            $mediaName = $this->is_image($media) ? $this->save_image($media, 'img/stories') : $this->save_video($media, 'video/stories');
            $story->media = $mediaName;
            if ($story->save())
                return $this->apiResponse(new StoryResource($story), 201, __('messages.story.store'));
            return $this->apiResponse(null, 500, __('messages.failed'));
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
            'media' => 'required|mimes:jpg,jpeg,svg,png,gif,jfif,pjpeg,pjp,webp,avif,x-ms-asf,x-flv,mp4,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv,avi'

        ];
    }

    public function messages()
    {
        return [
            'media.required' => __('messages.story.media.required'),
            'media.mimes' => __('messages.story.media.mimes'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(null, 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
}
