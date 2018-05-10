<?php

namespace App\Infrastructure\Domain;

use App\Domain\Repository\OfferedAnswerRepository;
use App\Domain\Entity\OfferedAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DbalOfferedAnswerRepository extends ServiceEntityRepository implements OfferedAnswerRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function add(OfferedAnswer $offeredAnswers)
    {
        $this->getEntityManager()->persist($offeredAnswers);
        $this->getEntityManager()->flush();
    }
}