<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function __construct(private User $user)
    {
    }

    public function createUser(array $data) : User
    {
        $user = $this->user->create($data);
        if ($user->isAuthor()) $user->categories()->sync($this->formatPermittedCategoriesArray($data['categories']));
        return $user;
    }

    private function formatPermittedCategoriesArray(string $categories) : array
    {
        $permittedCategoryArr = [];
        foreach(json_decode($categories, true) as $categoryId => $isPermitted) {
            if ($isPermitted) $permittedCategoryArr[] = $categoryId;
        }
        return $permittedCategoryArr;
    }
}
