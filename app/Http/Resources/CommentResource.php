<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
          'comment_id'=>$this->id,
          'comment'=>$this->comment,
          'user'=>new UserResource($this->user),
          'created_before'=>$this->created_at->diffForHumans()
        ];
    }
}
