<?php

namespace App\Application\Command\OfferedAnswer;

use App\Domain\Repository\OfferedAnswerRepository;

class DeleteOfferedAnswerHandler
{
    private $offeredAnswer;

    public function __construct(OfferedAnswerRepository $offeredAnswer)
    {
        $this->offeredAnswer = $offeredAnswer;
    }

    public function handle(DeleteOfferedAnswerCommand $command)
    {
        $offeredAnswer = $this->offeredAnswer->find($command->getId());
        $this->offeredAnswer->delete($offeredAnswer);
    }

}