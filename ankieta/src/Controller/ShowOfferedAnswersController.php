<?php

namespace App\Controller;

use App\Entity\OfferedAnswers;
use App\Form\EndType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ShowOfferedAnswersController extends Controller
{
    public function index(Request $request, SessionInterface $session)
    {
        $questiondata = $session->get('question');
        $offeredanswers = $this->getDoctrine()
            ->getRepository(OfferedAnswers::class)
            ->findBy(
                ['id_question' => $questiondata->getId()]
            );
        $formend = $this->createForm(EndType::class);
        $formend->handleRequest($request);
        if ($formend->isSubmitted() && $formend->isValid())
        {
                $session->remove('question');
                $session->remove('haveOffAns');
                return $this->redirect('/add/question/'.($questiondata->getIdSurvey()));
        }
        return $this->render('show_offered_answers/index.html.twig', [
            'items' => $offeredanswers,
            'formend' => $formend->createView()
        ]);
    }
}
