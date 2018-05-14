<?php

namespace App\Application\Query\Answer;

interface AnswerQuery
{
    public function AnswerCount(): int;

    public function getById(string $answerId): AnswerView;

    public function getManyByIdSurvey(string $answerIdSurvey): array;

    public function getAll(): array;
}

