<?php

namespace App\Survey\Domain\Survey\Repository;

use App\Survey\Domain\Survey\Entity\Survey;

interface SurveyRepository
{
    public function add(Survey $survey);
}