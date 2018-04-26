<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Form\GenerateSurveyType;
use App\Entity\Questions;
use App\Entity\OfferedAnswers;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


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
        return $this->redirect('/survey/fill/'.$link);
    }
    /**
     * @Route("/survey/fill/{string}", name="fill_survey")
     */
    public function fillAction($string, Request $request)
    {
        $arr = str_split($string);
        for($i = 0; $i < 10; $i++)
        {
            array_shift($arr);
        }
        $id = implode($arr);
        $form = $this->createForm(GenerateSurveyType::class, null, array('id_survey' => $id));
        if ($form->isSubmitted() && $form->isValid()) 
        {
                $data = $form->getData();
        }
        if(isset($data))
        {
            return $this->render('fill_survey/index.html.twig', 
                ['data' => $data,] 
            );
        }
        else
        {
            return $this->render('fill_survey/index.html.twig', 
                array('form' => $form->createView(), 
            ));
        }
        
    }

}
