<?php

namespace App\UI\Controller;

use App\Application\Query\Question\QuestionQuery;
use App\Application\Query\Answer\AnswerQuery;
use App\Application\Query\Survey\SurveyQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowTableAnswersController extends Controller
{
    private $answerQuery;

    private $questionQuery;

    private $surveyQuery;

    public function __construct(AnswerQuery $answerQuery, QuestionQuery $questionQuery, SurveyQuery $surveyQuery)
    {
        $this->answerQuery = $answerQuery;
        $this->questionQuery = $questionQuery;
        $this->surveyQuery = $surveyQuery;
    }


    public function indexAction()
    {
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
