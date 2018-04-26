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
    /**
     * Matches /dziekujemy/*
     *
     * @Route("/dziekujemy/{id}", name="thankU")
     */
    public function index($id, SessionInterface $session, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $questions = $entityManager
                        ->getRepository(Questions::class)
                        ->findBy(['id_survey' => $id]);
        $formend = $this->createForm(EndType::class);
        $formend->handleRequest($request);
        if ($formend->isSubmitted() && $formend->isValid())
        {
            $session->remove('IamNew');
            $session->remove('id_survey');
            return $this->redirectToRoute('control_panel');
        }
        return $this->render('you_made_survey/index.html.twig', [
            'formend' => $formend->createView(),
            'items' => $questions
        ]);
    }
}
