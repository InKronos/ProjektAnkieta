<?php

namespace App\Domain\Repository;

use App\Domain\Entity\RebateCode;

interface RebateCodeRepository
{
    public function add(RebateCode $code);

    public function update(RebateCode $code);
}