<?php

namespace App\Application\Command\RebateCode;

use App\Domain\Repository\RebateCodeRepository;
use App\Domain\Entity\RebateCode;

class CreateNewCodeHandeler
{
    private $code;

    public function __construct(RebateCodeRepository $code)
    {
        $this->code = $code;
    }

    public function handle(CreateNewCodeCommand $command)
    {
        $code = new RebateCode(
            $command->getCode()
        );

        $this->code->add($code);
    }
}