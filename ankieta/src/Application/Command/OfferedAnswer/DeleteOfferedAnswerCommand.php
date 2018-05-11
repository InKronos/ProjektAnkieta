<?php

namespace App\Application\Command\OfferedAnswer;


class DeleteOfferedAnswerCommand
{
    private $id;

    public function __construct(string $id)
    {
        $this->id =$id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

}