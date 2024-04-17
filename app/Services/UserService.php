<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;

class UserService
{
    public function createUser(UserDTO $userDTO): User
    {
        $user = new User();
        $user->name = $userDTO->name;
        $user->department_id = $userDTO->department_id;
        $user->save();

        return $user;
    }
}