<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OfferedAnswersRepository")
 */
class OfferedAnswers
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
     * @ORM\Column(type="integer")
     */
    private $id_question;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content;

   
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
    
    public function getIdQuestion(): ?int
    {
        return $this->id_question;
    }

    public function setIdQuestion(int $id_question): self
    {
        $this->id_question = $id_question;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }


}
