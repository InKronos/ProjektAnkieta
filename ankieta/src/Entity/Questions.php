<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionsRepository")
 */
class Questions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_survey;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     */
    private $typ;


    public function getId()
    {
        return $this->id;
    }

    public function getIdSurvey(): ?int
    {
        return $this->id_survey;
    }

    public function setIdSurvey(int $id_survey): self
    {
        $this->id_survey = $id_survey;

        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getTyp(): ?int
    {
        return $this->typ;
    }

    public function setTyp(int $typ): self
    {
        $this->typ = $typ;

        return $this;
    }

  
    
}
