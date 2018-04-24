<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\Questions;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShowSurveyController extends Controller
{
    /**
     * @Route("/show/survey", name="show_survey")
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
}
