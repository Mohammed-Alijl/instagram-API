<?php

namespace App\Http\Requests\Api\StoryView;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Story;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class ShowRequest extends FormRequest
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

    public function run($id)
    {
        try {
            $story = Story::find($id);
            if(!$story)
                return $this->apiResponse(null,404,__('messages.story.notFound'));
            $view = DB::table('views')->where(['user_id' => auth('user')->id(), 'story_id' => $id])->first();
            if ($view)
                return $this->apiResponse(['view' => true], 200, __('messages.story.view.show.true'));
            return $this->apiResponse(['view' => false], 200, __('messages.story.view.show.false'));
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
