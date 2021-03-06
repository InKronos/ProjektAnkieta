<?php

namespace App\Infrastructure\Domain;

use App\Domain\Repository\QuestionRepository;
use App\Domain\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 */

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

    public function delete(Question $question)
    {
        $this->getEntityManager()->remove($question);
        $this->getEntityManager()->flush();
    }

    public function update(Question $question)
    {
        $this->getEntityManager()->flush();
    }
}