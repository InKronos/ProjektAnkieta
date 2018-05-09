<?php

namespace App\Application\Command;


use App\Domain\Entity\Survey;
use App\Domain\Repository\SurveyRepository;

class CreateNewSurveyHandler
{
    private $survey;

    public function __construct(SurveyRepository $survey)
    {
        $this->survey = $survey;
    }

    public function handle(CreateNewSurveyCommand $command) : void
    {
        $survey = new Survey(
            $command->getName()
        );

        $this->survey->add($survey);
    }
}
