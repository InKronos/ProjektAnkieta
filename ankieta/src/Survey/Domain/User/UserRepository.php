<?php

namespace App\Survey\Domain\Repository;

use App\Survey\Domain\User\User;

interface UserRepository
{
    public function add(User $user);
}