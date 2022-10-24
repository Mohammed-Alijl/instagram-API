<?php

namespace App\Http\Requests\Api\Reels;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ReelsResource;
use App\Models\Reels;
use App\Traits\VideoTrait;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreRequest extends FormRequest
{
    use Api_Response, VideoTrait;

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
            $reels = new Reels();
            $reels->user_id = auth('user')->id();
            $reelsName = $this->save_video($this->reels, 'video/reels/');
            $reels->reels = $reelsName;
            if ($reels->save())
                return $this->apiResponse(new ReelsResource($reels), 201, __('messages.reels.store'));
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
            'reels' => 'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,video/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
        ];
    }

    public function messages()
    {
        return [
            'reels.required' => __('messages.reels.required'),
            'reels.mimetypes' => __('messages.reels.mimes'),
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
