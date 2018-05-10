<?php


namespace App\UI\Controller;

use App\Application\Command\CreateNewSurveyCommand;
use App\UI\Form\SurveyType;
use League\Tactician\CommandBus;
use App\Application\Query\Survey\SurveyQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MakeSurveyController extends Controller
{
    private $commandBus;

    private $surveyQuery;

    public function __construct(CommandBus $commandBus, SurveyQuery $surveyQuery)
    {
        $this->commandBus = $commandBus;
        $this->surveyQuery = $surveyQuery;
    }

    public function addAction(Request $request)
    {
        $formsurvey = $this->createForm(SurveyType::class);
        $formsurvey->handleRequest($request);
        
        if ($formsurvey->isSubmitted() && $formsurvey->isValid())
        {
            $data = $formsurvey["name"]->getData();

            $command = new CreateNewSurveyCommand($data);
            $this->commandBus->handle($command);

            $survey = $this->surveyQuery->getByName($data);
            return $this->redirectToRoute('add_question', ['id' => $survey->getId()]);
        }

        return $this->render('survey/renderSurvey.html.twig', [
            'formsurvey' => $formsurvey->createView(),
        ]);
    }

}