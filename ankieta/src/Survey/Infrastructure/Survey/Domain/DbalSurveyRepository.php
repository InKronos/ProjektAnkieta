<?php

namespace App\Survey\Infrastructure\User\Domain;

use App\Survey\Domain\Survey\Entity\Survey
use App\Survey\Domain\Survey\Repository\SurveyRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class DbalSurveyRepository extends ServiceEntityRepository implements SurveyRepository
{
    public function add(Survey $survey)
    {
        $this->getEntityManager()->persist($survey);
        $this->getEntityManager()->flush();
    }
}