<?php

namespace App\Application\Command\Question;

use App\Domain\Repository\QuestionRepository;

class UpdateQuestionHandler
{
    private $question;

    public function __construct(QuestionRepository $question)
    {
        $this->question = $question;
    }

    public function handle(UpdateQuestionCommand $command)
    {
        $question = $this->question->find($command->getId());
        $question->setContent($command->getContent());
        $question->setTyp($command->getTyp());

        $this->question->update($question);
    }

}