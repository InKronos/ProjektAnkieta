<?php


namespace App\Controller;

use App\Entity\Survey;
use App\Entity\Questions;
use App\Form\QuestionType;
use App\Form\SurveyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class MakeSurveyController extends Controller
{
	public function make(Request $request)
	{
		$surveydata = new Survey();
        $surveydata->setName('Ankieta dla ...');
		$formsurvey = $this->createForm(SurveyType::class, $surveydata);
		$questiondata = new Questions();

        $formsurvey->handleRequest($request);
         
        if ($formsurvey->isSubmitted() && $formsurvey->isValid())
        {
            $formquestion = $this->createForm(QuestionType::class, $questiondata);
            return $this->render('survey/renderQuestion.html.twig', array(
                'formquestion' => $formquestion->createView(), 
                'artykul' => $surveydata
            ));
        }
        return $this->render('survey/renderSurvey.html.twig', array(
            'formsurvey' => $formsurvey->createView(),
        ));
	}
}