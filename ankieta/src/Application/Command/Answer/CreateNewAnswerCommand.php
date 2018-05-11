<?php

namespace App\Application\Command\Answer;


class CreateNewAnswerCommand
{
    private $id_survey;

    private $answers;

    public function __construct(string $id_survey, array $answers)
    {
        $this->id_survey = $id_survey;
        $this->answers = $answers;
    }

    /**
     * @return string
     */
    public function getIdSurvey(): string
    {
        return $this->id_survey;
    }

    /**
     * @return array
     */
    public function getAnswers(): array
    {
        return $this->answers;
    }

}