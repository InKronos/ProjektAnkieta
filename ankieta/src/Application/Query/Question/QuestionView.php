<?php

namespace App\Application\Query\Question;


class QuestionView
{
    private $id;

    private $id_survey;

    private $content;

    private $typ;

    public function __construct($id, $id_survey, $content, $typ)
    {
        $this->id = $id;
        $this->id_survey = $id_survey;
        $this->content = $content;
        $this->typ = $typ;
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
    public function getIdSurvey()
    {
        return $this->id_survey;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getTyp()
    {
        return $this->typ;
    }


}