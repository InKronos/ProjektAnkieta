<?php

namespace App\Application\Command\User;

use App\Domain\Repository\UserRepository;
use App\Domain\Entity\User;

class CreateNewUserHandler
{
    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function handle(CreateNewUserCommand $command)
    {
        $user = new User(
            $command->getLogin(),
            $command->getPassword()
        );

        $this->user->add($user);
    }
}