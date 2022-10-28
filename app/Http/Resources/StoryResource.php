<?php

namespace App\Http\Resources;

use App\Traits\ImageTrait;
use App\Traits\VideoTrait;
use Illuminate\Http\Resources\Json\JsonResource;

class StoryResource extends JsonResource
{
    use ImageTrait, VideoTrait;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'story_id' => $this->id,
            'user_id' => $this->user_id,
            'media' => $this->isImage($this->media) ? asset('img/stories/' . $this->media) : asset('video/stories/' . $this->media)
        ];
    }
}
