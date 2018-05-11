<?php

namespace App\Application\Command\OfferedAnswer;

use App\Domain\Entity\OfferedAnswer;
use App\Domain\Repository\OfferedAnswerRepository;

class CreateNewOfferedAnswerHandler
{
    private $offeredAnswer;

    public function __construct(OfferedAnswerRepository $offeredAnswer)
    {
        $this->offeredAnswer = $offeredAnswer;
    }

    public function handle(CreateNewOfferedAnswerCommand $command): void
    {
        $offeredAnswer = new OfferedAnswer(
            $command->getIdQuestion(),
            $command->getContent()
        );

        $this->offeredAnswer->add($offeredAnswer);
    }
}