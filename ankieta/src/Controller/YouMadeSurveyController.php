<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class YouMadeSurveyController extends Controller
{
    public function index(SessionInterface $session)
    {
        $session->remove('needOneQue');
        $session->remove('survey');
        return $this->render('you_made_survey/index.html.twig', [
            'controller_name' => 'YouMadeSurveyController',
        ]);
    }
}
