<?php

namespace App\Application\Command\Survey;

use App\Domain\Entity\Survey;
use App\Domain\Repository\SurveyRepository;

class DeleteSurveyHandler
{
    private $survey;

    public function __construct(SurveyRepository $survey)
    {
        $this->survey = $survey;
    }

    public function handle(DeleteSurveyCommand $command) : void
    {
       $survey = $this->survey->find($command->getId());
       $this->survey->delete($survey);
    }
}