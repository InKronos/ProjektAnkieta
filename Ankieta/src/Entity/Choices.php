<?php

namespace App\Entity;

/**
* 
*/
class Choices
{
    protected $choice;
    
    function getChoice()
    {
        return $this->choice;
    }

    function setChoice($choice)
    {
        $this->choice = $choice;
    }
}