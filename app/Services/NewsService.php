<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    public function __construct(private News $news)
    {}

    public function uploadImg($data) : string
    {
        $path = $data->store('news', 'public');
        return  Storage::disk('public')->url($path);
    }
}
