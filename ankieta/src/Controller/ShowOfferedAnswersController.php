<?php

namespace App\Controller;

use App\Entity\OfferedAnswers;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShowOfferedAnswersController extends Controller
{
    /**
     * @Route("/show/offered/answers", name="show_offered_answers")
     */
    public function index()
    {

        return $this->render('show_offered_answers/index.html.twig', [
            'controller_name' => 'ShowOfferedAnswersController',
        ]);
    }
}
