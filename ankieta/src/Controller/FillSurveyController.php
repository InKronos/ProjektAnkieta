<?php

namespace App\Controller;

use App\Entity\Survey;
use App\Entity\Answers;
use App\Entity\RebateCode;
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
        $data = [];
        $form = $this->createForm(GenerateSurveyType::class, null, array('id_survey' => $id));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
                $entityManager = $this->getDoctrine()->getManager();
                $data = $form->getData();
                $answers = new Answers();
                $answers->setIdSurvey($id);
                $answers->setAnswers($data);
                $entityManager->persist($answers);
                $entityManager->flush();


                return $this->redirectToRoute("thanks_survey");
        }
        return $this->render('fill_survey/index.html.twig', 
                array('form' => $form->createView(),
            ));
    }
    /*
     * @Route("/survey/thanks", name="thanks_survey")
     */
    public function thanksAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $Rcode = $entityManager
                    ->getRepository(RebateCode::class)
                    ->findOneBy(['used' => false]);
        if(!$Rcode)
        {
            return $this->redirectToRoute("generate_code");
        }
        else
        {
            $Rcode->setUsed(true);
            $entityManager->flush();
            return $this->render('fill_survey/thanks.html.twig', [
                'rebate' => $Rcode
            ]);
        }


    }

}
