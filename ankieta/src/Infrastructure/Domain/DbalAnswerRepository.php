<?php

namespace App\Infrastructure\Domain;

use App\Domain\Entity\Answer;
use App\Domain\Repository\AnswerRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Answer|null find($id, $lockMode = null, $lockVersion = null)
 */

class DbalAnswerRepository extends ServiceEntityRepository implements AnswerRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Answer::class);
    }

    public function add(Answer $answer)
    {
        $this->getEntityManager()->persist($answer);
        $this->getEntityManager()->flush();
    }

    public function delete(Answer $answer)
    {
        $this->getEntityManager()->remove($answer);
        $this->getEntityManager()->flush();
    }
}