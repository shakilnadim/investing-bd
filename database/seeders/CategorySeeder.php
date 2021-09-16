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
                'name' => 'বাংলাদেশ',
                'slug' => 'বাংলাদেশ',
                'category_id' => null,
                'is_published' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name' => 'রাজনীতি',
                'slug' => 'রাজনীতি',
                'category_id' => 1,
                'is_published' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name' => 'ব্যাবসা',
                'slug' => 'ব্যাবসা',
                'category_id' => 1,
                'is_published' => 1,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name' => 'খেলাধুলা',
                'slug' => 'খেলাধুলা',
                'category_id' => null,
                'is_published' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
            [
                'name' => 'ক্রিকেট',
                'slug' => 'ক্রিকেট',
                'category_id' => 4,
                'is_published' => 0,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ],
        ];
    }
}
