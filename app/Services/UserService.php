<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;

class UserService
{
    public function list()
    {
        $users = User::all();
        return $users;
    }

    public function show($userId)
    {
        $user = User::findOrFail($userId);
        return $user;
    }

    public function createUser(UserDTO $userDTO): User
    {
        $user = new User();
        $user->name = $userDTO->name;
        $user->department_id = $userDTO->department_id;
        $user->save();

        return $user;
    }

    public function updateUser($userId, UserDTO $userDTO): User
    {
        $user = User::findOrFail($userId);
        $user->name = $userDTO->getName();
        $user->department_id = $userDTO->getDepartmentId();
        $user->save();

        return $user;
    }
}
