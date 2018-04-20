<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Form\QuestionType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MakeQuestionController extends Controller
{
    /**
     * @Route("/make/question", name="make_question")
     */
    public function index()
    {
        /*$questiondata = new Questions();
        $formquestion = $this->createForm(QuestionType::class, $questiondata);
            
        $formsurvey->handleRequest($request);
        return $this->render('survey/renderQuestion.html.twig', array(
                'formquestion' => $formquestion->createView(), 
                'artykul' => $surveydata
            ));*/
    }
}
