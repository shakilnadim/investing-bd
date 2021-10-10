<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryNews extends JsonResource
{
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'category' => $this->category,
            'time_ago' => $this->start_time > $this->created_at ? $this->start_time->diffForHumans() : $this->created_at->diffForHumans(),
            'featured_img' => get_thumbnail($this->featured_img),
            'slug' => $this->slug,
        ];
    }
}
