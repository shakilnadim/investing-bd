<?php
use Illuminate\Database\Eloquent\Collection;

if (!function_exists('add_placeholder_to_collection')){
    function add_placeholder_to_collection(Collection $rows, $placeHolderText, string $keyColumn, string $valueColumn='id') : Collection
    {
        $data = collect([$valueColumn => '', $keyColumn => $placeHolderText]);
        return $rows->prepend($data);
    }
}
