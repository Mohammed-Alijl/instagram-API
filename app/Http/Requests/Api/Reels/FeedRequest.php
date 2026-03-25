<?php

namespace App\Http\Requests\Api\Reels;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ReelsResource;
use App\Models\Reels;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FeedRequest extends FormRequest
{
    use Api_Response;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Public endpoint - anyone can access
    }

    public function run()
    {
        try {
            // Get reels from all users, ordered by most recent first
            $reels = Reels::with('user')
                ->latest()
                ->paginate(config('constants.POST_PAGINATION'));
            
            return $this->apiResponse(ReelsResource::collection($reels), 200, __('messages.reels.index'));
        } catch (Exception $ex) {
            return $this->apiResponse(null, 500, $ex->getMessage());
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<int, string>
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
