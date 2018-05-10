<?php

namespace App\Infrastructure\Doctrine;

use App\Application\Query\Survey\SurveyQuery;
use App\Application\Query\Survey\SurveyView;
use Doctrine\DBAL\Connection;

class DbalSurveyView implements SurveyQuery
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function surveyCount(): int
    {
        return $this->connection->fetchColumn('SELECT COUNT(id) FROM surveys');
    }

    public function getById(string $surveyId): SurveyView
    {
        $result = $this->connection->fetchAssoc('
            SELECT s.id, s.name FROM surveys AS s 
            WHERE s.id = :id',
            [
                ':id' => $surveyId,
            ]
        );
        if(!$result);

        return new SurveyView($result['id'], $result['name']);
    }

    public function getByName(string $surveyName) : SurveyView
    {
        $result = $this->connection->fetchAssoc('
            SELECT s.id, s.name FROM surveys AS s 
            WHERE s.name = :nazwa',
            [
                ':nazwa' => $surveyName,
            ]
        );
        if(!$result)
        {
            die();
        }
        return new SurveyView($result['id'], $result["name"]);
    }

    public function getAll(): array
    {
        $results = $this->connection->fetchAll('SELECT s.id, s.name FROM surveys AS s ');

        return array_map(function (array  $result){
            return new SurveyView($result['id'], $result['name']);
        }, $results);
    }
}