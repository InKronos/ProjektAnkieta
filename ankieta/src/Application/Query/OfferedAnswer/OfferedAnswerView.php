<?php

namespace App\Application\Query\OfferedAnswer;


class OfferedAnswerView
{
    private $id;

    private $id_question;

    private $content;

    public function __construct($id, $id_question, $content)
    {
        $this->id =$id;
        $this->id_question = $id_question;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getIdQuestion()
    {
        return $this->id_question;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }


}