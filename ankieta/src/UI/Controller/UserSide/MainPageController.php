<?php

namespace App\UI\Controller\UserSide;

use App\Application\Query\Survey\SurveyQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainPageController extends Controller
{
    private $surveyQuery;

    public function __construct(SurveyQuery $surveyQuery)
    {
        $this->surveyQuery = $surveyQuery;
    }

    public function indexAction()
    {
        $surveyData = $this->surveyQuery->getAll();


        return $this->render('main_page/index.html.twig', [
            'surveys' => $surveyData,
        ]);
    }
}
