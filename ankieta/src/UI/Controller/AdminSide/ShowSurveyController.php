<?php

namespace App\UI\Controller\AdminSide;

use App\Application\Query\Survey\SurveyQuery;
use App\Application\Query\Question\QuestionQuery;
use League\Tactician\CommandBus;
use App\Application\Query\OfferedAnswer\OfferedAnswerQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ShowSurveyController extends Controller
{
    private $commandBus;

    private $surveyQuery;

    private $questionQuery;

    private $offeredAnswerQuery;

    private $session;

    public function __construct(CommandBus $commandBus, SurveyQuery $surveyQuery, QuestionQuery $questionQuery, OfferedAnswerQuery $offeredAnswerQuery, SessionInterface $session)
    {
        $this->commandBus = $commandBus;
        $this->surveyQuery = $surveyQuery;
        $this->questionQuery = $questionQuery;
        $this->offeredAnswerQuery = $offeredAnswerQuery;
        $this->session = $session;
    }

    public function showSurvey()
    {
        if(!($this->session->has('login'))) {
            return $this->redirectToRoute('main_page');
        }

        $surveyData = $this->surveyQuery->getAll();
        
        return $this->render('show_survey/index.html.twig', [
            'items' => $surveyData,
        ]);
    }

    public function showQuestions($id)
    {
        if(!($this->session->has('login'))) {
            return $this->redirectToRoute('main_page');
        }

        $surveyData = $this->surveyQuery->getById($id);
        $questionData = $this->questionQuery->getManyByIdSurvey($id);

        return $this->render('show_survey/showQuestions.html.twig', [
            'items' => $questionData,
            'survey' => $surveyData
        ]);
    }

     public function showQuestionAnswers($id)
     {
         if(!($this->session->has('login'))) {
             return $this->redirectToRoute('main_page');
         }

        $questionData = $this->questionQuery->getById($id);
        $offeredanswersData = $this->offeredAnswerQuery->getManyByIdQuestion($id);
        $id_survey = $questionData->getIdSurvey();


        return $this->render('show_survey/showQuestion.html.twig', [
            'question' => $questionData,
            'answers' => $offeredanswersData,
        ]);
     }
}
