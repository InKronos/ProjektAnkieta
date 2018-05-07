<?php

namespace App\Survey\Infrastructure\User\Domain;

use App\Survey\Domain\Survey\Entity\Question;
use App\Survey\Domain\Survey\Repository\QuestionRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DbalQuestionRepository extends ServiceEntityRepository implements QuestionRepository
{
    public function add(Question $question)
    {
        $this->getEntityManager()->persist($question);
        $this->getEntityManager()->flush();
    }
}