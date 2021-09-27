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
            Image::MEDIUM => '760x450',
            Image::THUMBNAIL => '380x200',
            Image::XS => '60x45',
        ]
    ]
];
