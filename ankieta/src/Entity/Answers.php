<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AnswersRepository")
 */
class Answers
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
     * @ORM\Column(type="array")
     */
    private $answers;

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

    public function getAnswers(): ?array
    {
        return $this->answers;
    }

    public function setAnswers(array $answers): self
    {
        $this->answers = $answers;

        return $this;
    }
}
