<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert($this->setAndGetCategories());
    }

    private function setAndGetCategories() : array
    {
        $timestamp = Carbon::now();
        return [
            [
                'name' => 'Bangladesh',
                'slug' => 'bangladesh',
                'is_published' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name' => 'Politics',
                'slug' => 'politics',
                'is_published' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'is_published' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name' => 'Sports',
                'slug' => 'sports',
                'is_published' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ];
    }
}
