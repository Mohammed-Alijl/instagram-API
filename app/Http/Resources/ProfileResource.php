<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if (auth('user')->id() == $this->id)
            return [
                'user_id' => $this->id,
                'name' => $this->name,
                'nick_name' => $this->nick_name,
                'bio' => $this->bio,
                'image_url' => asset('img/users/profile/' . $this->image),
                'posts_num' => $this->posts()->count(),
                'followers_num' => $this->followers()->count(),
                'following_num' => $this->follow()->count(),
            ];
        $followHim = DB::table('user_followers')->where(['user_id' => $this->id, 'follower_id' => auth('user')->id()])->first();
        return [
            'user_id' => $this->id,
            'name' => $this->name,
            'nick_name' => $this->nick_name,
            'bio' => $this->bio,
            'image_url' => asset('img/users/profile/' . $this->image),
            'posts_num' => $this->posts()->count(),
            'followers_num' => $this->followers()->count(),
            'following_num' => $this->follow()->count(),
            'youFollowHim' => (bool)$followHim,
        ];
    }
}
