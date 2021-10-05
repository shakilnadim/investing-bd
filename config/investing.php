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
            Image::MEDIUM => '640x400',
            Image::THUMBNAIL => '320x200',
            Image::XS => '60x45',
        ]
    ]
];
