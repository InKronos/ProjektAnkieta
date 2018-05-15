<?php

namespace App\Application\Query\User;


class UserView
{
    private $id;

    private $login;

    private  $password;

    public function __construct($id, $login, $password)
    {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
    }


}