<?php

namespace App\Survey\Domain\Survey\Repository;

use App\Survey\Domain\Survey\Entity\OfferedAnswer;

interface OfferedAnswerRepository
{
    public function add(OfferedAnswer $offeredAnswer);
}