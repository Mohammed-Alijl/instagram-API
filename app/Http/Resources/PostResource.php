<?php

namespace App\Http\Resources;

use App\Traits\ImageTrait;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

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
        $like = DB::table('likes')->where(['post_id' => $this->id, 'user_id' => auth('user')->id()])->first();
        $save = DB::table('post_saves')->where(['post_id' => $this->id, 'user_id' => auth('user')->id()])->first();
        $medias = [];
        foreach ($this->media as $media)
            $this->isImage($media->media) ? $medias[] = asset('img/posts/' . $media->media) : $medias[] = asset('video/posts/' . $media->media);
        return [
            'post_id' => $this->id,
            'user' => new UserResource($this->user),
            'caption' => $this->caption,
            'post_media' => $medias,
            'likes_num' => $this->userlikes()->count(),
            'is_favorite' => (bool)$like,
            'is_saved' => (bool)$save,
            'num_of_comments' => $this->comments()->count()
        ];
    }
}
