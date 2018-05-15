<?php

namespace App\Application\Query\User;

interface UserQuery
{
    public function userCount() : int;

    public function getById(string $userId): ?UserView;

    public function getByLoginAndPassword(string $userLogin, string $userPassword): ?UserView;

    public function getAll() : array;
}