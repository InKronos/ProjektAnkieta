<?php

namespace App\Survey\Domain\Survey\Repository;

use App\Survey\Domain\Survey\Entity\Question;

interface QuestionRepository
{
    public function add(Question $question);
}