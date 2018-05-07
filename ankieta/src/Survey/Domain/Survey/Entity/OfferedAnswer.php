<?php

namespace App\Survey\Domain\Survey\Entity;

use Ramsey\Uuid\Uuid;


class OfferedAnswer
{
    /** @var \Ramsey\Uuid\UuidInterface  */
    private $id;

    private $id_question;

    private $content;

    public function __construct($id_question, $content)
    {
        $this->id = Uuid::uuid4();
        $this->id_question = $id_question;
        $this->content = $content;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdQusetion()
    {
        return $this->id_question;
    }

    public function getcontent()
    {
        return $this->content;
    }
}