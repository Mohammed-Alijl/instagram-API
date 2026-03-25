<?php

namespace App\Http\Requests\Api\Reels;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\ReelsResource;
use App\Models\Reels;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserReelsRequest extends FormRequest
{
    use Api_Response;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Public endpoint
    }

    public function run($userId)
    {
        try {
            // Get reels from specific user, ordered by most recent first
            $reels = Reels::where('user_id', $userId)
                ->with('user')
                ->latest()
                ->get();
            
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
