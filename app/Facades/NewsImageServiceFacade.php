<?php


namespace App\Facades;

use App\Services\NewsImageService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;


class NewsImageServiceFacade extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return NewsImageService::class;
    }
}
