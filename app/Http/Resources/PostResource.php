<?php

namespace App\Http\Resources;

use App\Traits\ImageTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    use ImageTrait;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $medias = [];
        foreach ($this->media as $media)
            $this->isImage($media->media) ? $medias[] = config('constants.WEBSITE_URL') . 'public/img/posts/' . $media->media : $medias[] = config('constants.WEBSITE_URL') . 'public/video/posts/' . $media->media;

        return [
            'post_id' => $this->id,
            'user' => new UserResource($this->user),
            'caption' => $this->caption,
            'post_media' => $medias,
            'likes_num' => $this->userlikes()->count(),
        ];
    }
}
