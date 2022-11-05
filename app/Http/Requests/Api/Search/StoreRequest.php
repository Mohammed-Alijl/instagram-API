<?php

namespace App\Http\Requests\Api\Search;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\SearchHistoryResource;
use App\Models\SearchHistory;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            $searchHistory = auth('user')->user()->searchHistory;
            if($searchHistory->count() >= 15)
                $searchHistory->where('created_at',$searchHistory->min('created_at'))->first()->delete();
            $search = new SearchHistory();
            $search->user_id = auth('user')->id();
            $search->search = $this->toSave;
            if($search->save())
                return $this->apiResponse(new SearchHistoryResource($search),201,__('messages.search..history.store'));
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
            'toSave'=>'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
          'toSave.required'=>__('messages.search.history.toSave.required'),
          'toSave.string'=>__('messages.search.history.toSave.string'),
          'toSave.max'=>__('messages.search.history.toSave.max'),
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
