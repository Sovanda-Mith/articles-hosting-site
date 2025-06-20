<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->follow_id,
            'follower_id' => $this->follower_id,
            'following_id' => $this->following_id,
            'follower' => $this->whenLoaded('follower', [
                'id' => $this->follower?->id,
                'name' => $this->follower?->name,
                'username' => $this->follower?->username,
                'avatar' => $this->follower?->avatar,
            ]),
            'following' => $this->whenLoaded('following', [
                'id' => $this->following?->id,
                'name' => $this->following?->name,
                'username' => $this->following?->username,
                'avatar' => $this->following?->avatar,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
