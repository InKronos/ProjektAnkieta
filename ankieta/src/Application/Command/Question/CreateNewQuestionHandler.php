<?php

namespace App\Application\Command\Question;

use App\Domain\Entity\Question;
use App\Domain\Repository\QuestionRepository;

class CreateNewQuestionHandler
{
    private $question;

    public function __construct(QuestionRepository $question)
    {
        $this->question = $question;
    }

    public function handle(CreateNewQuestionCommand $command) : void
    {
        $question = new Question(
            $command->getIdSurvey(),
            $command->getContent(),
            $command->getTyp()
        );

        $this->question->add($question);
    }
}