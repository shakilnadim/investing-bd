<?php

namespace App\View\Components\Visitor;

use App\Services\NewsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class HomeFeaturedNews extends Component
{
    public function __construct(private NewsService $newsService, public Collection $featuredNewsList)
    {
        $this->featuredNewsList = $this->getFeaturedNewsList();
    }

    public function restOfFeaturedNews() : Collection
    {
        $this->featuredNewsList->shift();
        return $this->featuredNewsList;
    }

    private function getFeaturedNewsList() : Collection
    {
        return $this->newsService->getLatestPublishedFeaturedNews(5);
    }

    public function render()
    {
        return view('components.visitor.home-featured-news');
    }
}
