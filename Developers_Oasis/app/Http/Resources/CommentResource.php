<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
               'id' => $this->id,
               'body' => $this->body,
               'user_id' => new UserResource($this->user),
               'post_id'=>new PostResource($this->post),
               'commentable_type'=>$this->commentable_type,
               'commentable_id'=>$this->commentable_id,
        ];

    }
}
