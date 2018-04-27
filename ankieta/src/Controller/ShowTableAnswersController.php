<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\Questions;
use App\Entity\Answers;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowTableAnswersController extends Controller
{
    /**
     * @Route("/show/table/answers", name="show_table_answers")
     */
    public function index()
    {

        $answersdata = $this->getDoctrine()
                        ->getRepository(Answers::class)
                        ->findAll();
        $questiondata = $this->getDoctrine()
                        ->getRepository(Questions::class)
                        ->findAll();
        $surveydata = $this->getDoctrine()
                        ->getRepository(Survey::class)
                        ->findAll();
       /* foreach ($answersdata as $answer)
        {
            $questiondata = $this->getDoctrine()
                ->getRepository(Questions::class)
                ->findBy(['id_survey' => $answer->getIdSurvey()]);
            $table =  $answer->getAnswers();
            $table_keys = array_keys($table);
        }*/

        return $this->render('show_table_answers/index.html.twig', [
            'questions' => $questiondata,
            'answers' => $answersdata,
            'surveys' => $surveydata
        ]);
    }
}
