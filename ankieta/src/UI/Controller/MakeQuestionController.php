<?php

namespace App\UI\Controller;

use App\Application\Command\Question\CreateNewQuestionCommand;
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

        $questionData = $this->questionQuery->getByIdSurvey($id);
        if($questionData->getId() == 'nothing'){
            $haveQue = false;
        } else {
            $haveQue = true;
        }

        if ($formQuestion->isSubmitted() && $formQuestion->isValid())
        {
            $command = new CreateNewQuestionCommand($id, $formQuestion['content']->getData(), $formQuestion['typ']->getData());
            $this->commandBus->handle($command);

            $questionData = $this->questionQuery->getOneByIdSurveyAndContent($id, $formQuestion['content']->getData());

            if($questionData->getTyp() == 1 || $questionData->getTyp() == 2)
            {
                return $this->redirectToRoute('add_offered_answer', ['option' => 'add', 'id' => $questionData->getId()]);
            }
            else
            {
                return $this->redirectToRoute('add_question', ['id' => $surveyData->getId()]);
            }
        }

        return $this->render('make_question/addQuestion.html.twig', [
                'formQuestion' => $formQuestion->createView(),
                'artykul' => $surveyData,
                'haveQue' => $haveQue,
            ]);
    }
}
