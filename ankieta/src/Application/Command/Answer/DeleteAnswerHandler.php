<?php

namespace App\Application\Command\Answer;

use App\Domain\Repository\AnswerRepository;

class DeleteAnswerHandler
{
    private $answer;

    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    public function handle(DeleteAnswerCommand $command)
    {
        $answer = $this->answer->find($command->getId());
        $this->answer->delete($answer);
    }
}