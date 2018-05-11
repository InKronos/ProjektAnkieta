<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Answer;

interface AnswerRepository
{
    public function add(Answer $answer);

    public function delete(Answer $answer);
}