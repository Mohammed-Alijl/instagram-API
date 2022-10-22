<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_id'=>$this->id,
            'name'=>$this->name,
            'nick_name'=>$this->nick_name,
            'bio'=>$this->bio,
            'image_url'=>config('constants.WEBSITE_URL') . '/public/img/users/profile/' . $this->image,
            'posts_num'=>$this->posts()->count(),
            'followers_num'=>$this->followers()->count(),
            'following_num'=>$this->follow()->count()
        ];
    }
}
