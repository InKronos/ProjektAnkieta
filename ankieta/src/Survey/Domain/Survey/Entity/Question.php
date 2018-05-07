<?php

namespace App\Survey\Domain\Survey\Entity;

use Ramsey\Uuid\Uuid;


class Question
{
    /** @var \Ramsey\Uuid\UuidInterface  */
    private $id;

    private $id_survey;

    private $content;

    private $type;

    public function __construct($id_survey, $content, $type)
    {
        $this->id = Uuid::uuid4();
        $this->id_survey = $id_survey;
        $this->content = $content;
        $this->type = $type;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdSurvey()
    {
        return $this->id_survey;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getType()
    {
        return $this->type;
    }
}