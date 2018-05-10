<?php

namespace App\UI\Controller;

use App\Application\Command\CreateNewQuestionCommand;
use App\UI\Form\QuestionType;
use League\Tactician\CommandBus;
use App\Application\Query\Survey\SurveyQuery;
use App\Application\Query\Question\QuestionQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MakeQuestionController extends Controller
{
    private $commandBus;

    private $surveyQuery;

    private $questionQuery;

    public function __construct(CommandBus $commandBus, SurveyQuery $surveyQuery, QuestionQuery $questionQuery)
    {
        $this->commandBus = $commandBus;
        $this->surveyQuery = $surveyQuery;
        $this->questionQuery = $questionQuery;
    }

    public function addAction($id, Request $request)
    {
        $formQuestion = $this->createForm(QuestionType::class);
        $formQuestion->handleRequest($request);
        $surveyData = $this->surveyQuery->getById($id);
        /*$HowManyQue = $entityManager
            ->getRepository(Questions::class)
            ->findBy(['id_survey' => $surveydata->getId()]);

        /*if(!$HowManyQue) {
            $sthIsNeed = false;
        } else {
            $sthIsNeed = true;
        }*/

       /* if($session->has('IamNew')) {
            $INew = true;
        } else {
            $INew = false;
        }*/

        if ($formQuestion->isSubmitted() && $formQuestion->isValid())
        {
            $command = new CreateNewQuestionCommand($id, $formQuestion['content']->getData(), $formQuestion['typ']->getData());
            $this->commandBus->handle($command);

            $questionData = $this->questionQuery->getByIdSurvey($id);

            if($questionData->getTyp() == 1 || $questionData->getTyp() == 2)
            {
                //return $this->redirect('/question/answer/add/'.$questiondata->getId());
            }
            else
            {
                return $this->redirectToRoute('add_question', ['id' => $surveyData->getId()]);
            }
        }

        /*if ($formend->isSubmitted() && $formend->isValid())
        {
                return $this->redirect('/dziekujemy/'.($surveydata->getId()));
        }*/

        return $this->render('make_question/addQuestion.html.twig', [
                'formQuestion' => $formQuestion->createView(),
                'artykul' => $surveyData,
            ]);
    }


}
