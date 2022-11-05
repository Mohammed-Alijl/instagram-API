<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = User::where('name', $this->search)->first();
        if ($user)
            return [
                'id'=>$this->id,
                'search_history'=> new UserResource($user),
            ];
        else
            return [
                'id'=>$this->id,
                'search_history'=> $this->search
            ];
    }
}
