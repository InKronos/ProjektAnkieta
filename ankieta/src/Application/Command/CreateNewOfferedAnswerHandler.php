<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10.05.18
 * Time: 14:55
 */

namespace App\Application\Command;

use App\Domain\Entity\OfferedAnswer;
use App\Domain\Repository\OfferedAnswerRepository;

class CreateNewOfferedAnswerHandler
{
    private $offeredAnswer;

    public function __construct(OfferedAnswerRepository $offeredAnswer)
    {
        $this->offeredAnswer = $offeredAnswer;
    }

    public function handle(CreateNewOfferedAnswerCommand $command)
    {
        $offeredAnswer = new OfferedAnswer(
            $command->getIdQuestion(),
            $command->getContent()
        );
        $this->offeredAnswer->add($offeredAnswer);
    }
}