<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Entity\Survey;
use App\Form\QuestionType;
use App\Form\EndType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MakeQuestionController extends Controller
{
      /**
     * Matches /add/question/*
     *
     * @Route("/add/question/{id}", name="add_question")
     */
    public function index($id, Request $request, SessionInterface $session)
    {
        $questiondata = new Questions();
        $formquestion = $this->createForm(QuestionType::class, $questiondata);
        $formend = $this->createForm(EndType::class);
        $formquestion->handleRequest($request);
        $formend->handleRequest($request);
        $surveydata = $this->getDoctrine()
            ->getRepository(Survey::class)
            ->findOneBy(['id' => $id]);
        if(!($session->has('haveQue')))
        {
            $sthIsNeed = false;
        }
        else
            $sthIsNeed = true;

        if($session->has('IamNew'))
        {
            $INew = true;
            $session->set('survey', $surveydata);
        }
        else
            $INew = false;

        $entityManager = $this->getDoctrine()->getManager();
        if ($formquestion->isSubmitted() && $formquestion->isValid())
        {
            
            $questiondata->setIdSurvey($surveydata->getId());
            $entityManager->persist($questiondata);
            $entityManager->flush();
            if(!($session->has('haveQue')))
                $session->set('haveQue', 'Teraz masz pytanie');
            if($questiondata->getTyp() == 1 || $questiondata->getTyp() == 2)
            {
                $session->set('question', $questiondata);
                return $this->redirectToRoute('make_offeredanswers');
            }
            else
            {
                return $this->redirect('/add/question/'.($surveydata->getId()));
            }
        }
        if ($formend->isSubmitted() && $formend->isValid())
        {
                return $this->redirectToRoute('thanksforsurvey');
        }
        return $this->render('make_question/renderQuestion.html.twig', array(
                'formquestion' => $formquestion->createView(),
                'artykul' => $surveydata,
                'formend' => $formend->createView(),
                'sthIsNeed' => $sthIsNeed,
                'new' => $INew
            ));
    }

}
