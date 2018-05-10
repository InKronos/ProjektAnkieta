<?php

namespace App\Domain\Entity;

use Ramsey\Uuid\Uuid;

class OfferedAnswer
{
    private $id;

    private $id_question;

    private $content;

    public function __construct(string $id_question, string $content)
    {
        $this->id = Uuid::uuid4();
        $this->id_question = $id_question;
        $this->content = $content;
    }
}