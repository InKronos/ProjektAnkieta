<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Form\GenerateSurveyType;
use App\Entity\Questions;
use App\Entity\OfferedAnswers;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;


class FillSurveyController extends Controller
{
    /**
     * @Route("/survey/{id}", name="survey")
     */
    public function index($id, SessionInterface $session)
    {
        $surveydata = $this->getDoctrine()
            ->getRepository(Survey::class)
            ->find($id);
        if(!$surveydata)
        {
            return $this->redirect('/');
        }

        if(!$session->has('security'))
            return $this->redirect('/');
        else
            $session->remove('security');
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $link = $randomString.$id;
        return $this->redirect('/fill/survey/'.$link);
    }
    /**
     * @Route("/fill/survey/{string}", name="fill_survey")
     */
    public function fill($string)
    {

        $arr = str_split($string);
        for($i = 0; $i < 10; $i++)
        {
            array_shift($arr);
        }
        $id = implode($arr);
        $session = new Session();
        $questiondata = $this->getDoctrine()
            ->getRepository(Questions::class)
            ->findBy([
                'id_survey' => $id
                ]);
        $offeredanswersdata = $this->getDoctrine()
            ->getRepository(OfferedAnswers::class)
            ->findBy([
                'id_survey' => $id
            ]);
        $session->set('questiondata', $questiondata);
        $session->set('offeredanswersdata', $offeredanswersdata);
        $form = $this->createForm(GenerateSurveyType::class);
        return $this->render('fill_survey/index.html.twig', 
            array('form' => $form->createView(), 

        ));
    }

}
