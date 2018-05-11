<?php

namespace App\Domain\Repository;

use App\Domain\Entity\OfferedAnswer;

interface OfferedAnswerRepository
{
    public function add(OfferedAnswer $offeredAnswers);

    public function delete(OfferedAnswer $offeredAnswer);
}