<?php


namespace App\Controller;

use App\Entity\Survey;
use App\Entity\Questions;
use App\Form\QuestionType;
use App\Form\SurveyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class MakeSurveyController extends Controller
{

    public function make(Request $request, SessionInterface $session)
    {
        $surveydata = new Survey();
        $surveydata->setName('Ankieta dla ...');
        $formsurvey = $this->createForm(SurveyType::class, $surveydata);
        $questiondata = new Questions();
        $entityManager = $this->getDoctrine()->getManager();
        $formsurvey->handleRequest($request);
        
        if ($formsurvey->isSubmitted() && $formsurvey->isValid())
        {
            $session->set('IamNew', 'jestem nową ankieta');
            $entityManager->persist($surveydata);
            $entityManager->flush();
            return $this->redirect('/question/add/'.($surveydata->getId()));
        }
        return $this->render('survey/renderSurvey.html.twig', array(
            'formsurvey' => $formsurvey->createView(),
        ));
    }
}