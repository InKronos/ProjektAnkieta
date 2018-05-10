<?php

namespace App\Application\Query\OfferedAnswer

interface OfferedAnswerQuery
{
    public function OfferedAnswerCount(): int;

    public function getById(string $offeredAnswerId): OfferedAnswerView;

    public function getByIdQuestion(string  $offeredAnswerIdQuestion): OfferedAnswerView;

    public function getAll(): array;
}