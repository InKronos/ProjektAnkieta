<?php

namespace App\Controller;

use App\Entity\Survey;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class MainPageController extends Controller
{
    public function index(SessionInterface $session)
    {
        $surveydata = $this->getDoctrine()
                ->getRepository(Survey::class)
                ->findAll()
            ;
        $session->set('security', 'I want sth');

        return $this->render('main_page/index.html.twig', [
            'surveys' => $surveydata,
        ]);
    }
}
