<?php

namespace App\Http\Requests\Api\StoryView;

use App\Http\Controllers\Api\Traits\Api_Response;
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
            $isView = DB::table('views')->where(['user_id' => auth('user')->id(), 'story_id' => $this->story_id])->first();
            if ($isView)
                return $this->apiResponse(['views' => false], 422, __('messages.story.view.exists'));
            $view = DB::table('views')->insert(['user_id' => auth('user')->id(), 'story_id' => $this->story_id]);
            if ($view)
                return $this->apiResponse(['view' => true], 201, __('messages.story.view.store'));
            return $this->apiResponse(['view' => false], 500, __('messages.failed'));
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
            'story_id' => 'required|numeric|exists:stories,id'
        ];
    }

    public function messages()
    {
        return [
            'story_id.required' => __('messages.story.view.story_id.required'),
            'story_id.numeric' => __('messages.story.view.story_id.numeric'),
            'story_id.exists' => __('messages.story.view.story_id.exists'),
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiResponse(['view' => false], 422, $validator->errors()));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
}
