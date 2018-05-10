<?php

namespace App\Infrastructure\Domain;

use App\Domain\Repository\QuestionRepository;
use App\Domain\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class DbalQuestionRepository extends ServiceEntityRepository implements QuestionRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Question::class);
    }

    public function add(Question $question)
    {
        $this->getEntityManager()->persist($question);
        $this->getEntityManager()->flush();
    }
}