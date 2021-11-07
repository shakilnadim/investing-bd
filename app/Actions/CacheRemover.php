<?php

namespace App\Actions;

use Illuminate\Support\Facades\Cache;

class CacheRemover
{
    private array $cacheEventKeys = [
        'ad-update' => ['ads'],
    ];

    public function handle($event) : void
    {
        foreach ($this->cacheEventKeys[$event] as $key) {
            Cache::forget($key);
        }
    }
}
