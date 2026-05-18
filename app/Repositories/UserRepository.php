<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function updateProfile($user, array $data)
    {
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        return $user;
    }

    public function updatePassword($user, string $newPassword)
    {
        $user->password = Hash::make($newPassword);
        $user->save();

        return $user;
    }
}
