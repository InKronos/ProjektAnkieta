<?php

namespace App\Application\Command\OfferedAnswer;


class CreateNewOfferedAnswerCommand
{
    private $id_question;

    private $content;

    public function __construct(string $id_question, string $content)
    {
        $this->id_question = $id_question;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getIdQuestion(): string
    {
        return $this->id_question;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

}