<?php

namespace App\Infrastructure\Domain;

use App\Domain\Entity\Survey;
use App\Domain\Repository\SurveyRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Survey|null find($id, $lockMode = null, $lockVersion = null)
 */

class DbalSurveyRepository extends ServiceEntityRepository implements SurveyRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Survey::class);
    }

    public function add(Survey $survey)
    {
        $this->getEntityManager()->persist($survey);
        $this->getEntityManager()->flush();
    }

    public function delete(Survey $survey)
    {
        $this->getEntityManager()->remove($survey);
        $this->getEntityManager()->flush();
    }
}

