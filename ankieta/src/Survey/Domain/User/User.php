<?php


namespace App\Survey\Domain\User;

use Ramsey\Uuid\Uuid;

class User
{
    /** @var \Ramsey\Uuid\UuidInterface */
    private $id;

    private $login;

    private $password;

    private $email;

    public function __construct($login, $password, $email)
    {
        $this->id = Uuid::uuid4();
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }
}