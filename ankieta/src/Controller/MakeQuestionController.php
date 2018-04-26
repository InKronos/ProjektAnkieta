<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Entity\Survey;
use App\Entity\OfferedAnswers;
use App\Form\QuestionType;
use App\Form\EndType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MakeQuestionController extends Controller
{
      /**
     * Matches /question/add/*
     *
     * @Route("/question/add/{id}", name="question_add")
     */
    public function AddAction($id, Request $request, SessionInterface $session)
    {
        $questiondata = new Questions();
        $formquestion = $this->createForm(QuestionType::class, $questiondata);
        $formend = $this->createForm(EndType::class);
        $formquestion->handleRequest($request);
        $formend->handleRequest($request);
        $surveydata = $this->getDoctrine()
            ->getRepository(Survey::class)
            ->find($id);
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
                return $this->redirect('/question/add/'.($surveydata->getId()));
            }
        }
        if ($formend->isSubmitted() && $formend->isValid())
        {
                return $this->redirectToRoute('thanksforsurvey');
        }
        return $this->render('make_question/addQuestion.html.twig', array(
                'formquestion' => $formquestion->createView(),
                'artykul' => $surveydata,
                'formend' => $formend->createView(),
                'sthIsNeed' => $sthIsNeed,
                'new' => $INew
            ));
    }
      /**
     * @Route("/question/edit/{id}", name="question_edit")
     */
    public function EditAction($id, Request $request, SessionInterface $session)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $questiondata = $entityManager->getRepository(Questions::class)->find($id);
        $questioninfo = array('id' => $questiondata->getId(),'typ' => $questiondata->getTyp());
        $formquestion = $this->createForm(QuestionType::class, $questiondata);
        $formquestion->handleRequest($request);
        if ($formquestion->isSubmitted() && $formquestion->isValid())
        {
            $entityManager->flush();
            if($questioninfo['typ'] == 1 || $questioninfo['typ'] == 2)
            {
                $offeredanswerdata = $entityManager->getRepository(OfferedAnswers::class)->findBy(['id_question' => $id]);
                foreach ($offeredanswerdata as &$answer) 
                {
                    $entityManager->remove($answer);
                }
                $entityManager->flush();
            }
            if($questiondata->getTyp() == 1 || $questiondata->getTyp() == 2)
            {
                $session->set('question', $questiondata);
                $session->set('edit', 'I am Edited');
                return $this->redirectToRoute('make_offeredanswers');
            }
            else
            {
                return $this->redirect('/show/survey/question/'.($questiondata->getId()));
            }
        }
        return $this->render('make_question/editQuestion.html.twig', array(
                'formquestion' => $formquestion->createView(),
                'question' => $questiondata
            ));
    }

}
