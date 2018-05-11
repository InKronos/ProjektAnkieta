<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Survey;

interface SurveyRepository
{
    public function add(Survey $survey);

    public function delete(Survey $survey);
}