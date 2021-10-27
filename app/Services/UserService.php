<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(private User $user)
    {
    }

    public function createUser(array $data) : User
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->user->create($data);
        if ($user->isAuthor()) $user->categories()->sync($this->formatPermittedCategoriesForDb($data['categories']));
        return $user;
    }

    public function updateUser($user, array $data) : User
    {
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        $permittedCategories = [];
        if ($user->isAuthor()) $permittedCategories = $this->formatPermittedCategoriesForDb($data['categories']);

        $user->categories()->sync($permittedCategories);

        return $user;
    }

    private function formatPermittedCategoriesForDb(string $categories) : array
    {
        $permittedCategoryArr = [];
        foreach(json_decode($categories, true) as $categoryId => $isPermitted) {
            if ($isPermitted) $permittedCategoryArr[] = $categoryId;
        }
        return $permittedCategoryArr;
    }

    public function formatPermittedCategoriesForUi(Collection $categories) : string
    {
        $data = [];
        foreach($categories as $category) {
            $data[$category->id] = true;
        }
        return json_encode($data);
    }
}
