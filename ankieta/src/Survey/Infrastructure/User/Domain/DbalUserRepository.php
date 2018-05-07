<?php

namespace App\Survey\Infrastructure\User\Domain;

use App\Survey\Domain\User\User;
use App\Survey\Domain\User\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DbalUserRepository extends ServiceEntityRepository implements UserRepository
{
    public function add(User $user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
}
