<?php

use App\Consts\Roles;
use App\Consts\Image;

return [
    'roles' => [
        Roles::USER,
        Roles::AUTHOR,
        Roles::ADMIN,
    ],

    'image' => [
        'dimensions' => [
            Image::LARGE => '1000x600',
            Image::MEDIUM => '650x450',
            Image::THUMBNAIL => '250x150',
        ]
    ]
];
