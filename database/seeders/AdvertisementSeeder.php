<?php

namespace Database\Seeders;

use App\Consts\Advertisements;
use App\Models\Advertisement;
use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder
{
    public function run()
    {
        $ads = [
            [
                'placement' => Advertisements::HEADER,
            ],
            [
                'placement' => Advertisements::MAIN_1,
            ],
            [
                'placement' => Advertisements::MAIN_2,
            ],
            [
                'placement' => Advertisements::SIDEBAR_1,
            ],
            [
                'placement' => Advertisements::SIDEBAR_2,
            ],
            [
                'placement' => Advertisements::SIDEBAR_3,
            ]
        ];
        Advertisement::insert($ads);
    }
}
