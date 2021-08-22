<?php

namespace Database\Seeders;

use App\Consts\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::insert($this->setAndGetUsers());
    }

    private function setAndGetUsers() : array
    {
        $timestamp = Carbon::now();
        return [
            [
                'name' => 'shakil',
                'email' => 'shakilnadim@gmail.com',
                'password' => Hash::make('shakil123'),
                'role' => Roles::ADMIN,
                'created_at' => $timestamp
            ],
            [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('shakil123'),
                'role' => Roles::USER,
                'created_at' => $timestamp
            ],
            [
                'name' => 'author',
                'email' => 'author@gmail.com',
                'password' => Hash::make('shakil123'),
                'role' => Roles::AUTHOR,
                'created_at' => $timestamp
            ],
        ];
    }
}
