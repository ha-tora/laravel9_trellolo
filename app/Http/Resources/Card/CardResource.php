<?php

namespace App\Http\Resources\Card;

use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\User\UserShortResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'user' => new UserShortResource($this->user),
            'comments' => CommentResource::collection($this->comments)
        ];
    }
}
