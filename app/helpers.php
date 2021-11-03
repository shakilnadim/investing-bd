<?php
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

if (!function_exists('add_placeholder_to_collection')){
    function add_placeholder_to_collection(Collection $rows, $placeHolderText, string $keyColumn, string $valueColumn='id') : Collection
    {
        $data = collect([$valueColumn => '', $keyColumn => $placeHolderText]);
        return $rows->prepend($data);
    }
}

if (!function_exists('get_start_of_day_timestamp')){
    function get_start_of_date_timestamp($date) : string
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date . '00:00:00')->format('Y-m-d H:i:s');
    }
}

if (!function_exists('get_end_of_day_timestamp')){
    function get_end_of_date_timestamp($date) : string
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date . '23:59:59')->format('Y-m-d H:i:s');
    }
}

if (!function_exists('get_thumbnail')){
    function get_thumbnail(string $image) : string
    {
        return json_decode($image)->{\App\Consts\Image::THUMBNAIL};
    }
}

if (!function_exists('get_img')){
    function get_img(string $image, string $size) : string
    {
        return json_decode($image)->{$size};
    }
}

if (!function_exists('get_parent_category_name')){
    function get_parent_category_name(\App\Models\News $news) : string
    {
        if (is_uncategorized($news)) return 'Uncategorized';
        return $news->category->parentCategory->name ?? $news->category->name;
    }
}

if (!function_exists('get_sub_category_name')){
    function get_sub_category_name(\App\Models\News $news) : string | null
    {   if (is_uncategorized($news)) return 'Uncategorized';
        return isset($news->category->parentCategory->name) ? $news->category->name : null;
    }
}

if (!function_exists('is_uncategorized')){
    function is_uncategorized(\App\Models\News $news) : bool
    {
        if (!isset($news->category) || ($news->category->category_id && !isset($news->category->parentCategory))) return true;
        return false;
    }
}

if (!function_exists('get_header_ad')){
    function get_header_ad() : \App\Models\Advertisement | null
    {
        $advertisementService = app(\App\Services\AdvertisementService::class);
        $publishedAds = $advertisementService->getCachedPublishedAds();
        return $publishedAds->where('placement', 'header')->first();
    }
}
