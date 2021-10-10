<?php

namespace App\View\Components\Visitor;

use App\Services\NewsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class LatestNews extends Component
{
    public function __construct(private NewsService $newsService)
    {
        //
    }

    public function latestNews() : Collection
    {
        return $this->newsService->getLatestNews(5);
    }

    public function render()
    {
        return view('components.visitor.latest-news');
    }
}
