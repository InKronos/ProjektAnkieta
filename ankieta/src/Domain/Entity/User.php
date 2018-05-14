<?php

namespace App\Domain\Entity;

use Ramsey\Uuid\Uuid;

class User
{
    private $id;

    private $login;

    private $password;

    public function __construct($login, $password)
    {
        $this->id = Uuid::uuid4();
        $this->login = $login;
        $this->password = $password;
    }


}