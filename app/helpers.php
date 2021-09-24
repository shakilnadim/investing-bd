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
