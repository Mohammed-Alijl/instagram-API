<?php

namespace App\Http\Resources;

use App\Traits\ImageTrait;
use App\Traits\VideoTrait;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

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
        $isWatched = DB::table('views')->where(['user_id'=>auth('user')->id(),'story_id'=>$this->id])->first();
        return [
            'story_id' => $this->id,
            'user_id' => $this->user_id,
            'media' => $this->isImage($this->media) ? asset('img/stories/' . $this->media) : asset('video/stories/' . $this->media),
            'is_watched'=>(bool)$isWatched
        ];
    }
}
