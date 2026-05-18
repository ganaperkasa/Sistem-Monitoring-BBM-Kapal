<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function updateProfile($user, array $data);
    public function updatePassword($user, string $newPassword);
}
