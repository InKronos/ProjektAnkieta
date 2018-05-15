<?php

namespace App\UI\Controller\AdminSide;

use App\Application\Query\Question\QuestionQuery;
use App\Application\Query\Answer\AnswerQuery;
use App\Application\Query\Survey\SurveyQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ShowTableAnswersController extends Controller
{
    private $session;

    private $answerQuery;

    private $questionQuery;

    private $surveyQuery;

    public function __construct(AnswerQuery $answerQuery, QuestionQuery $questionQuery, SurveyQuery $surveyQuery, SessionInterface $session)
    {
        $this->answerQuery = $answerQuery;
        $this->questionQuery = $questionQuery;
        $this->surveyQuery = $surveyQuery;
        $this->session = $session;
    }


    public function indexAction()
    {
        if(!($this->session->has('login'))) {
            return $this->redirectToRoute('main_page');
        }

        $answersData = $this->answerQuery->getAll();
        $questionData = $this->questionQuery->getAll();
        $surveyData =  $this->surveyQuery->getAll();


        return $this->render('show_table_answers/index.html.twig', [
            'questions' => $questionData,
            'answers' => $answersData,
            'surveys' => $surveyData
        ]);
    }
}
