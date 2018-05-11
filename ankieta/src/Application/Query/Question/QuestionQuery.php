<?php

namespace App\Application\Query\Question;

interface QuestionQuery
{
    public function questionCount(): int;

    public function getById(string  $questionId): QuestionView;

    public function getByIdSurvey(string $questionIdSurvey): QuestionView;

    public function getOneByIdSurveyAndContent(string $questionIdSurvey, string $questionContent): QuestionView;

    public function getManyByIdSurvey(string $questionIdSurvey): array;

    public function getAll(): array;

}