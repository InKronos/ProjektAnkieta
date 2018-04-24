<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Form\EndType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;

class YouMadeSurveyController extends Controller
{
    public function index(SessionInterface $session, Request $request)
    {
        $questions = $this->getDoctrine()
            ->getRepository(Questions::class)
            ->findBy(
                ['id_survey' => $session->get('survey')->getId()]
            );
        $formend = $this->createForm(EndType::class);
        $formend->handleRequest($request);
        if ($formend->isSubmitted() && $formend->isValid())
        {
            $session->remove('haveQue');
            $session->remove('IamNew');
            $session->remove('survey');
            return $this->redirectToRoute('control_panel');
        }
        return $this->render('you_made_survey/index.html.twig', [
            'formend' => $formend->createView(),
            'items' => $questions
        ]);
    }
}
