<?php

namespace App\Application\Command\RebateCode;

use App\Domain\Entity\RebateCode;
use App\Domain\Repository\RebateCodeRepository;

class UpdateCodeHandler
{
    private $code;

    public function __construct(RebateCodeRepository $code)
    {
        $this->code = $code;
    }

    public function handle(UpdateCodeCommand $command)
    {
        $code = $this->code->find($command->getId());
        $code->setUsed(true);
        $this->code->update($code);
    }
}