<?php

namespace App\Application\Query\Survey;


interface SurveyQuery
{
    public function surveyCount() : int;

    public function getById(string  $surveyId) : SurveyView;

    public function getByName(string $surveyName) : SurveyView;

    public function getAll() : array;
}