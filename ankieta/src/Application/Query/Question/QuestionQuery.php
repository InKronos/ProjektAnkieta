<?php

namespace App\Application\Query\Question;

interface QuestionQuery
{
    public function questionCount(): int;

    public function getById(string  $questionId): QuestionView;

    public function getByIdSurvey(string $questionIdSurvey): QuestionView;

    public function getAll(): array;

}