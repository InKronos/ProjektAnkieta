<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 10.05.18
 * Time: 15:16
 */

namespace App\Infrastructure\Doctrine;

use App\Application\Query\OfferedAnswer\OfferedAnswerQuery;
use App\Application\Query\OfferedAnswer\OfferedAnswerView;
use Doctrine\DBAL\Connection;

class DbalOfferedAnswerView implements OfferedAnswerQuery
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function OfferedAnswerCount(): int
    {
        return $this->connection->fetchColumn('SELECT COUNT(id) FROM offeredAnswes');
    }

    public function getById(string $offeredAnswerId): OfferedAnswerView
    {
        $result = $this->connection->fetchAssoc('
            SELECT oA.id, oA.id_question, oA.content FROM offeredAnswers AS oA 
            WHERE oA.id = :id',
            [
                ':id' => $offeredAnswerId,
            ]
        );

        if(!$result);

        return new OfferedAnswerView($result['id'], $result['id_question'], $result['content']);
    }

    public function getByIdQuestion(string $offeredAnswerIdQuestion): OfferedAnswerView
    {
        $result = $this->connection->fetchAssoc('
            SELECT oA.id, oA.id_question, oA.content FROM offeredAnswers AS oA 
            WHERE oA.id_question = :id_question',
            [
                ':id_question' => $offeredAnswerIdQuestion,
            ]
        );

        if(!$result)
            return new OfferedAnswerView( 'nothing', 'nothing', 'nothing');
        else
            return new OfferedAnswerView($result['id'], $result['id_question'], $result['content']);

    }

    public function getManyByIdQuestion(string $offeredAnswerIdQuestion): array
    {
        $results = $this->connection->fetchAll('
            SELECT oA.id, oA.id_question, oA.content FROM offeredAnswers AS oA 
            WHERE oA.id_question = :id_question',
            [
                ':id_question' => $offeredAnswerIdQuestion,
            ]
        );

        return array_map(function (array  $result){
            return new OfferedAnswerView($result['id'], $result['id_question'], $result['content']);
        }, $results);
    }

    public function getAll(): array
    {
        $results = $this->connection->fetchAll('SELECT oA.id, oA.id_question, oA.content FROM offeredAnswer AS oA');

        return array_map(function (array  $result){
            return new OfferedAnswerView($result['id'], $result['id_question'], $result['content']);
        }, $results);
    }
}