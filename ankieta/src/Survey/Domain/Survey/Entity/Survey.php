<?php

namespace App\Survey\Domain\Survey\Entity;

use Ramsey\Uuid\Uuid;


class Survey
{
    /** @var \Ramsey\Uuid\UuidInterface  */
    private $id;

    private $name;

    public function __construct($name)
    {
        $this->id = Uuid::uuid4();
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }
}