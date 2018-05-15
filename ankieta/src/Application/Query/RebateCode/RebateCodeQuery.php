<?php

namespace App\Application\Query\RebateCode;

interface RebateCodeQuery
{
    public function getNoneUsedCodes() : ?RebateCodeView;
}