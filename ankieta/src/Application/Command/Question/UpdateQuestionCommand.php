<?php


namespace App\Application\Command\Question;


class UpdateQuestionCommand
{
    private $id;

    private $content;

    private $typ;

    public function __construct($id, $content, $typ)
    {
        $this->id = $id;
        $this->content = $content;
        $this->typ = $typ;
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getTyp()
    {
        return $this->typ;
    }


}