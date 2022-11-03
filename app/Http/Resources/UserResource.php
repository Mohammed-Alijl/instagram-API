<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $followHim = DB::table('user_followers')->where(['user_id' => $this->id, 'follower_id' => auth('user')->id()])->first();
        return [
            'user_id' => $this->id,
            'name' => $this->name,
            'nick_name' => $this->nick_name,
            'image_url' => asset('img/users/profile/' . $this->image),
            'user_stories'=> StoryResource::collection($this->stories),
            'youFollowHim' => (bool)$followHim,
        ];
    }
}
