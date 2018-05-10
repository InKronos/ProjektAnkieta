<?php

namespace App\Application\Query\OfferedAnswer;


class OfferedAnswerView
{
    private $id;

    private $id_question;

    private $content;

    public function __construct(string $id, string $id_question, string $content)
    {
        $this->id =$id;
        $this->id_question = $id_question;
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
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