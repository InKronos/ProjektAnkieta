<?php

namespace App\Application\Query\Answer;


class AnswerView
{
    private $id;

    private $id_survey;

    private $answers;

    /**
     * AnswerView constructor.
     * @param $id
     * @param $id_survey
     * @param $answers
     */
    public function __construct($id, $id_survey, array $answers)
    {
        $this->id = $id;
        $this->id_survey = $id_survey;
        $this->answers = $answers;
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

    public function getAnswers(): ?array
    {
        return $this->answers;
    }






}