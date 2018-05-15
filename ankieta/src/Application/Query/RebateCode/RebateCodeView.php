<?php

namespace App\Application\Query\RebateCode;


class RebateCodeView
{
    private $id;

    private $code;

    private $used;

    public function __construct($id, $code, $used)
    {
        $this->id = $id;
        $this->code = $code;
        $this->used = $used;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getUsed()
    {
        return $this->used;
    }


}