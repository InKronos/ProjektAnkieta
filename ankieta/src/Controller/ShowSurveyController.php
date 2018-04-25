<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\Questions;
use App\Entity\OfferedAnswers;
use App\Form\EndType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ShowSurveyController extends Controller
{
    /**
     * @Route("/show/survey", name="show_surveys")
     */
    public function showSurvey()
    {
        $surveydata = $this->getDoctrine()
            ->getRepository(Survey::class)
            ->findAll()
            ;
        
        return $this->render('show_survey/index.html.twig', [
            'items' => $surveydata,
        ]);
    }
    /**
     * Matches /show/survery/*
     *
     * @Route("/show/survey/{id}", name="show_survey_questions")
     */
    public function showQuestions($id)
    {
        $surveydata = $this->getDoctrine()
            ->getRepository(Survey::class)
            ->findOneBy(['id' => $id]);
        $questiondata = $this->getDoctrine()
            ->getRepository(Questions::class)
            ->findBy(['id_survey' => $id]);
        return $this->render('show_survey/showQuestions.html.twig', [
            'items' => $questiondata,
            'survey' => $surveydata
        ]);
    }
     /**
     * Matches /show/survery/question/*
     *
     * @Route("/show/survey/question/{id}", name="show_survey_question")
     */
     public function showQuestion($id, Request $request)
     {
        $questiondata = $this->getDoctrine()
            ->getRepository(Questions::class)
            ->findOneBy(['id' => $id]);
        $offeredanswersdata = $this->getDoctrine()
            ->getRepository(OfferedAnswers::class)
            ->findBy(['id_question' => $id]);
        $id_survey = $questiondata->getIdSurvey();
        $formend = $this->createForm(EndType::class);
        $formend->handleRequest($request);
        if ($formend->isSubmitted() && $formend->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($questiondata);
            foreach ($offeredanswersdata as &$answer) {
                $entityManager->remove($answer);
            }
            $entityManager->flush();
            return $this->redirect('/show/survey/'.$id_survey);
        }
        return $this->render('show_survey/showQuestion.html.twig', [
            'question' => $questiondata,
            'answers' => $offeredanswersdata,
            'formend' => $formend->createView()
        ]);
     }
}
