<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryNews extends JsonResource
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
            'title' => $this->title,
            'short_description' => $this->short_description,
            'category' => $this->category,
            'time_ago' => $this->start_time > $this->created_at ? $this->start_time->diffForHumans() : $this->created_at->diffForHumans(),
            'featured_img' => json_decode($this->featured_img)->thumbnail,
            'slug' => $this->slug,
        ];
    }
}
