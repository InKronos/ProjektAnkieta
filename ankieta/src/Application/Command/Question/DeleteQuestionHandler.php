<?php

namespace App\Application\Command\Question;

use App\Domain\Repository\QuestionRepository;
use App\Application\Command\Question\DeleteQuestionCommand;

class DeleteQuestionHandler
{
    private $question;

    public function __construct(QuestionRepository $question)
    {
        $this->question = $question;
    }

    public function handle(DeleteQuestionCommand $command) : void
    {
        $question = $this->question->find($command->getId());

        $this->question->add($question);
    }
}