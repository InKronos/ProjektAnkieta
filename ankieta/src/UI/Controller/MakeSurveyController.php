<?php


namespace App\UI\Controller;

use App\Application\Command\CreateNewSurveyCommand;
use App\UI\Form\SurveyType;
use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MakeSurveyController extends Controller
{
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function addAction(Request $request, SessionInterface $session, CommandBus $commandBus)
    {
        $formsurvey = $this->createForm(SurveyType::class);
        $formsurvey->handleRequest($request);
        
        if ($formsurvey->isSubmitted() && $formsurvey->isValid())
        {
            $data = $formsurvey["name"]->getData();

            $command = new CreateNewSurveyCommand($data);
            $this->commandBus->handle($command);

            //return $this->redirect('/question/add/'.($surveydata->getId()));
        }

        return $this->render('survey/renderSurvey.html.twig', [
            'formsurvey' => $formsurvey->createView(),
        ]);
    }

}