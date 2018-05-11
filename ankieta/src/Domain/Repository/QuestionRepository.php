<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Question;

interface QuestionRepository
{
    public function add(Question $question);

    public function delete(Question $question);
}