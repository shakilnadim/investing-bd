<?php

namespace App\Actions;

use App\Consts\CacheEvents;
use Illuminate\Support\Facades\Cache;

class CacheRemover
{
    private array $cacheEventKeys = [
        CacheEvents::AD_UPDATE => ['ads'],
    ];

    public function handle($event) : void
    {
        foreach ($this->cacheEventKeys[$event] as $key) {
            Cache::forget($key);
        }
    }
}
