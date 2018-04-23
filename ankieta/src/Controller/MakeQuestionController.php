<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Form\QuestionType;
use App\Form\OfferedAnswerType;
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
        $questiondata->setContent('');
        $formquestion = $this->createForm(QuestionType::class, $questiondata);
        $formend = $this->createForm(EndType::class);
        $formquestion->handleRequest($request);
        $formend->handleRequest($request);
        $haveQuestion = true;
        $surveydata = $session->get('survey');
        $entityManager = $this->getDoctrine()->getManager();
        if ($formquestion->isSubmitted() && $formquestion->isValid())
        {
            
            $questiondata->setIdSurvey($surveydata->getId());
            $entityManager->persist($questiondata);
            $entityManager->flush();
            if($questiondata->getTyp() == 1 || $questiondata->getTyp() == 2)
            {
                $session->set('question', $questiondata);
                $haveQuestion = true;
                return $this->redirectToRoute('make_offeredanswers');
            }
    
                   
        }
        if ($formend->isSubmitted() && $formend->isValid())
        {
            if($haveQuestion == false)
            {
                
            }
            else
            {
                return $this->redirectToRoute('thanksforsurvey');
            }
        }
        return $this->render('make_question/renderQuestion.html.twig', array(
                'formquestion' => $formquestion->createView(),
                'artykul' => $surveydata,
                'formend' => $formend->createView()

            ));
    }
}
