<?php

namespace App\Application\Query\Question;


class QuestionView
{
    private $id;

    private $id_survey;

    private $content;

    private $typ;

    public function __construct(string $id, string $id_survey, string $content, int $typ)
    {
        $this->id = $id;
        $this->id_survey = $id_survey;
        $this->content = $content;
        $this->typ = $typ;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIdSurvey(): string
    {
        return $this->id_survey;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getTyp(): int
    {
        return $this->typ;
    }
}