<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Form\QuestionType;
use App\Form\EndType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MakeQuestionController extends Controller
{

    public function index(Request $request, SessionInterface $session)
    {
        $questiondata = new Questions();
        $formquestion = $this->createForm(QuestionType::class, $questiondata);
        $formend = $this->createForm(EndType::class);
        $formquestion->handleRequest($request);
        $formend->handleRequest($request);
        $sthIsNeed = false;
        $surveydata = $session->get('survey');
        $entityManager = $this->getDoctrine()->getManager();
        if ($formquestion->isSubmitted() && $formquestion->isValid())
        {
            
            $questiondata->setIdSurvey($surveydata->getId());
            $entityManager->persist($questiondata);
            $entityManager->flush();
            if(!($session->has('haveQue')))
            {
                $session->set('haveQue', 'Teraz już masz pytanie');
            }
            if($questiondata->getTyp() == 1 || $questiondata->getTyp() == 2)
            {
                $session->set('question', $questiondata);
                return $this->redirectToRoute('make_offeredanswers');
            }
            else
            {
                return $this->redirectToRoute('make_questions');
            }
    
                   
        }
        if ($formend->isSubmitted() && $formend->isValid())
        {
            if(!($session->has('haveQue')))
            {
                $sthIsNeed = true;
            }
            else
            {
                return $this->redirectToRoute('thanksforsurvey');
            }
        }
        return $this->render('make_question/renderQuestion.html.twig', array(
                'formquestion' => $formquestion->createView(),
                'artykul' => $surveydata,
                'formend' => $formend->createView(),
                'sthIsNeed' => $sthIsNeed
            ));
    }
}
