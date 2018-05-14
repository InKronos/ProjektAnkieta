<?php

namespace App\UI\Controller;

use App\Application\Query\Survey\SurveyQuery;
use App\Application\Query\Question\QuestionQuery;
use League\Tactician\CommandBus;
use App\Application\Query\OfferedAnswer\OfferedAnswerQuery;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShowSurveyController extends Controller
{
    private $commandBus;

    private $surveyQuery;

    private $questionQuery;

    private $offeredAnswerQuery;

    public function __construct(CommandBus $commandBus, SurveyQuery $surveyQuery, QuestionQuery $questionQuery, OfferedAnswerQuery $offeredAnswerQuery)
    {
        $this->commandBus = $commandBus;
        $this->surveyQuery = $surveyQuery;
        $this->questionQuery = $questionQuery;
        $this->offeredAnswerQuery = $offeredAnswerQuery;
    }

    public function showSurvey()
    {
        $surveyData = $this->surveyQuery->getAll();
        
        return $this->render('show_survey/index.html.twig', [
            'items' => $surveyData,
        ]);
    }

    public function showQuestions($id)
    {
        $surveyData = $this->surveyQuery->getById($id);
        $questionData = $this->questionQuery->getManyByIdSurvey($id);

        return $this->render('show_survey/showQuestions.html.twig', [
            'items' => $questionData,
            'survey' => $surveyData
        ]);
    }

     public function showQuestionAnswers($id)
     {
        $questionData = $this->questionQuery->getById($id);
        $offeredanswersData = $this->offeredAnswerQuery->getManyByIdQuestion($id);
        $id_survey = $questionData->getIdSurvey();

        /*if ($formend->isSubmitted() && $formend->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($questiondata);
            foreach ($offeredanswersdata as &$answer) {
                $entityManager->remove($answer);
            }

            $entityManager->flush();

            return $this->redirect('/show/survey/'.$id_survey);
        }*/

        return $this->render('show_survey/showQuestion.html.twig', [
            'question' => $questionData,
            'answers' => $offeredanswersData,
        ]);
     }
}
