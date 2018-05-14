<?php

namespace App\Domain\Entity;

use Ramsey\Uuid\Uuid;

class Question
{
    private $id;

    private $id_survey;

    private $content;

    private $typ;

    public function __construct(string $id_survey, string $content, int $typ)
    {
        $this->id = Uuid::uuid4();
        $this->id_survey = $id_survey;
        $this->content = $content;
        $this->typ = $typ;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @param int $typ
     */
    public function setTyp(int $typ): void
    {
        $this->typ = $typ;
    }


}
