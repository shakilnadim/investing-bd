<?php

if (!function_exists('format_key_values')){
    function format_key_values(\Illuminate\Database\Eloquent\Collection $rows, string $valueColumn, string $keyColumn='id', $nullValue = null) : array
    {
        $data = [];

        if ($nullValue) $data[''] = $nullValue;
        foreach ($rows as $row) {
            $data[$row->$keyColumn] = $row->$valueColumn;
        }
        return $data;
    }
}
