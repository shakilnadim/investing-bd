<?php

namespace App\Traits;

use App\Consts\Roles;

trait UserRole
{
    public function isAdmin() : bool
    {
        return $this->role === Roles::ADMIN;
    }

    public function isAuthor() : bool
    {
        return $this->role === Roles::AUTHOR;
    }

    public function isUser() : bool
    {
        return $this->role === Roles::USER;
    }
}
