<?php

namespace App\Infrastructure\Doctrine;

use App\Application\Query\User\UserView;
use App\Application\Query\User\UserQuery;
use Doctrine\DBAL\Connection;

class DbalUserView implements UserQuery
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function userCount(): int
    {
        return $this->connection->fetchColumn('SELECT COUNT(id) FROM users');
    }

    public function getById(string $userId): ?UserView
    {
        $result = $this->connection->fetchAssoc('
            SELECT u.id, u.login, u.password FROM users AS u 
            WHERE u.id = :id',
            [
                ':id' => $userId,
            ]
        );
        if(!$result){
            return null;
        } else {
            return new UserView($result['id'], $result['login'], $result['password']);
        }
    }

    public function getByLoginAndPassword(string $userLogin, string $userPassword): ?UserView
    {
        $result = $this->connection->fetchAssoc('
            SELECT u.id, u.login, u.password FROM users AS u 
            WHERE u.login = :login AND u.password = :password',
            [
                ':login' => $userLogin,
                ':password' => $userPassword,
            ]
        );
        if(!$result){
            return null;
        } else {
            return new UserView($result['id'], $result['login'], $result['password']);
        }
    }

    public function getAll(): array
    {
        $results = $this->connection->fetchAll('SELECT u.id, u.login, u.password FROM users AS u ');

        return array_map(function (array  $result){
            return new UserView($result['id'], $result['login'], $result['password']);
        }, $results);
    }
}