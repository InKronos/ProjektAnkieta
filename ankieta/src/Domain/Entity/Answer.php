<?php

namespace App\Domain\Entity;

use Ramsey\Uuid\Uuid;

class Answer
{
    private $id;

    private $id_survey;

    private $answers;

    public function __construct(string $id_survey, array $answers)
    {
        $this->id = Uuid::uuid4();
        $this->id_survey = $id_survey;
        $this->answers = $answers;
    }
}