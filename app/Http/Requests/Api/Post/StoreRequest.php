<?php

namespace App\Http\Requests\Api\Post;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostMedia;
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
            $post = new Post();
            $post->user_id = auth('user')->id();
            if ($this->filled('caption'))
                $post->caption = $this->caption;
            if (count($this->media) > 10)
                return $this->apiResponse(null, 422, __('messages.post.media.*.max'));
            if (!$post->save())
                return $this->apiResponse(null, 500, __('messages.failed'));
            foreach ($this->file('media') as $media) {
                $mediaName = $this->is_image($media) ? $this->save_image($media, 'img/posts') : $this->save_video($media, 'video/posts');
                $postMedia = new PostMedia();
                $postMedia->post_id = $post->id;
                $postMedia->media = $mediaName;
                $postMedia->save();
            }
            return $this->apiResponse(new PostResource($post), 201, __('messages.post.store'));

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
            'caption' => 'string|max:255',
            'media' => 'required|array',
            'media.*' => 'required|mimes:jpg,jpeg,svg,png,gif,jfif,pjpeg,pjp,webp,avif,x-ms-asf,x-flv,mp4,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv,avi'
        ];
    }

    public function messages()
    {
        return [
            'caption.string' => __('messages.post.caption.string'),
            'caption.max' => __('messages.post.caption.max'),
            'media.required' => __('messages.post.media.required'),
            'media.array' => __('messages.post.media.array'),
            'media.*.required' => __('messages.post.media.*.required'),
            'media.*.mimes' => __('messages.post.media.*.mimes'),
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
