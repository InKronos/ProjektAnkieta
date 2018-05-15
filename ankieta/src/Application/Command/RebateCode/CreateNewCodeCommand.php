<?php

namespace App\Application\Command\RebateCode;


class CreateNewCodeCommand
{
    private $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }
}