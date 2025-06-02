<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'id' => $this->article_id,
          'title' => $this->title,
          'subtitle' => $this->subtitle,
          'content' => $this->content,
          'user_id' => $this->user_id,
          'view_count' => $this->view_count,
          'status' => $this->status,
          'image' => $this->image,
          'likes_count' => $this->likes->count(),
          'comments_count' => $this->comments->count(),
          'created_at' => $this->created_at,
          'updated_at' => $this->updated_at,
        ];
    }
}
