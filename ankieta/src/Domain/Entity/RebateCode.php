<?php

namespace App\Domain\Entity;

use Ramsey\Uuid\Uuid;

class RebateCode
{
    private $id;

    private $code;

    private $used;

    public function __construct($code)
    {
        $this->id = Uuid::uuid4();
        $this->code = $code;
        $this->used = false;
    }

    /**
     * @param bool $used
     */
    public function setUsed(bool $used): void
    {
        $this->used = $used;
    }



}