<?php

namespace App\Survey\Infrastructure\User\Domain;

use App\Survey\Domain\Survey\Entity\OfferedAnswer;
use App\Survey\Domain\Survey\Repository\OfferedAnswerRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DbalOfferedAnswerRepository extends ServiceEntityRepository implements OfferedAnswerRepository
{
    public function add(OfferedAnswer $offeredAnswer)
    {
        $this->getEntityManager()->persist($offeredAnswer);
        $this->getEntityManager()->flush();
    }
}