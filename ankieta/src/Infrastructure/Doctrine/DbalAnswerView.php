<?php

namespace App\Infrastructure\Doctrine;

use App\Application\Query\Answer\AnswerView;
use App\Application\Query\Answer\AnswerQuery;
use Doctrine\DBAL\Connection;

class DbalAnswerView implements AnswerQuery
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function AnswerCount(): int
    {
        return $this->connection->fetchColumn('SELECT COUNT(id) FROM answers');
    }

    public function getById(string $answerId): AnswerView
    {
        $result = $this->connection->fetchAssoc('
            SELECT a.id, a.id_survey, a.answers FROM answers AS a 
            WHERE a.id = :id',
            [
                ':id' => $answerId,
            ]
        );

        if(!$result);

        return new AnswerView($result['id'], $result['id_survey'], unserialize($result['answers']));
    }

    public function getManyByIdSurvey(string $answerIdSurvey): array
    {
        $results = $this->connection->fetchAll('
            SELECT a.id, a.id_survey, a.answers FROM answers AS a 
            WHERE a.id_survey = :id_survey',
            [
                ':id_survey' => $answerIdSurvey,
            ]
        );


        return array_map(function (array  $result){
            return new AnswerView($result['id'], $result['id_survey'], unserialize($result['answers']));
        }, $results);

    }

    public function getAll(): array
    {
        $results = $this->connection->fetchAll('SELECT a.id, a.id_survey, a.answers FROM answers AS a ');

        return array_map(function (array  $result){
            return new AnswerView($result['id'], $result['id_survey'], unserialize($result['answers']));
        }, $results);
    }
}