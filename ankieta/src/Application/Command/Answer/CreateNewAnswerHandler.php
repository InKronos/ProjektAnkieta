<?php

namespace App\Application\Command\Answer;

use App\Domain\Entity\Answer;
use App\Domain\Repository\AnswerRepository;

class CreateNewAnswerHandler
{
    private $answer;

    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    public function handle(CreateNewAnswerCommand $command)
    {
        $answer = new Answer(
            $command->getIdSurvey(),
            $command->getAnswers()
        );

        $this->answer->add($answer);
    }
}