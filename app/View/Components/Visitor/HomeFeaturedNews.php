<?php

namespace App\View\Components\Visitor;

use App\Services\NewsService;
use Illuminate\View\Component;

class HomeFeaturedNews extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(private NewsService $newsService)
    {}

    public function featuredNewsList()
    {
        return $this->newsService->getLatestPublishedFeaturedNews(5);
    }

    public function render()
    {
        return view('components.visitor.home-featured-news');
    }
}
