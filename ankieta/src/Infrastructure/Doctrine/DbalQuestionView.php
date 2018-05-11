<?php

namespace App\Infrastructure\Doctrine;

use App\Application\Query\Question\QuestionQuery;
use App\Application\Query\Question\QuestionView;
use Doctrine\DBAL\Connection;

class DbalQuestionView implements QuestionQuery
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function questionCount(): int
    {
        return $this->connection->fetchColumn('SELECT COUNT(id) FROM questions');
    }

    public function getById(string $questionId): QuestionView
    {
        $result = $this->connection->fetchAssoc('
            SELECT q.id, q.id_survey, q.content, q.typ FROM questions AS q 
            WHERE q.id = :id',
            [
                ':id' => $questionId,
            ]
        );
        if(!$result);
        return new QuestionView($result['id'], $result['id_survey'], $result['content'], $result['typ']);
    }

    public function getByIdSurvey(string $questionIdSurvey): QuestionView
    {
        $result = $this->connection->fetchAssoc('
            SELECT q.id, q.id_survey, q.content, q.typ FROM questions AS q 
            WHERE q.id_survey = :id_survey',
            [
                ':id_survey' => $questionIdSurvey,
            ]
        );
        if(!$result);

        return new QuestionView($result['id'], $result['id_survey'], $result['content'], $result['typ']);
    }

    public function getOneByIdSurveyAndContent(string $questionIdSurvey, string $questionContent): QuestionView
    {
        $result = $this->connection->fetchAssoc('
            SELECT q.id, q.id_survey, q.content, q.typ FROM questions AS q 
            WHERE q.id_survey = :id_survey AND q.content = :content',
            [
                ':id_survey' => $questionIdSurvey,
                ':content' => $questionContent,
            ]
        );
        if(!$result){
            return new QuestionView('nothing', 'nothing', 'nothing', 'nothing');
        }

        return new QuestionView($result['id'], $result['id_survey'], $result['content'], $result['typ']);
    }

    public function getManyByIdSurvey(string $questionIdSurvey): array
    {
        $results = $this->connection->fetchAll('
            SELECT q.id, q.id_survey, q.content, q.typ FROM questions AS q 
            WHERE q.id_survey = :id_survey',
            [
                ':id_survey' => $questionIdSurvey,
            ]
        );
        if(!$results);

        return array_map(function (array  $result){
            return new QuestionView($result['id'], $result['id_survey'], $result['content'], $result['typ']);
        }, $results);
    }

    public function getAll(): array
    {
        $results = $this->connection->fetchAll('SELECT q.id, q.id_survey, q.content, q.typ FROM questions AS q ');

        return array_map(function (array  $result){
            return new QuestionView($result['id'], $result['id_survey'], $result['content'], $result['typ']);
        }, $results);
    }
}