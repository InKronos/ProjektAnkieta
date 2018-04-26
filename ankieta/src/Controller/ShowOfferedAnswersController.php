<?php

namespace App\Controller;

use App\Entity\OfferedAnswers;
use App\Entity\Questions;
use App\Form\EndType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ShowOfferedAnswersController extends Controller
{
    public function index(Request $request, SessionInterface $session)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $id_question = $session->get('id_question');
        $questiondata = $entityManager
                            ->getRepository(Questions::class)
                            ->find($id_question);
        $offeredanswers = $this->getDoctrine()
            ->getRepository(OfferedAnswers::class)
            ->findBy(
                ['id_question' => $questiondata->getId()]
            );
        $formend = $this->createForm(EndType::class);
        $formend->handleRequest($request);
        if ($formend->isSubmitted() && $formend->isValid())
        {
            $session->remove('id_question');
            if($session->has('edit'))
            {
                $session->remove('edit');
                return $this->redirect('/show/survey/question/'.($questiondata->getId()));
            }
            return $this->redirect('/question/add/'.($questiondata->getIdSurvey()));
        }
        return $this->render('show_offered_answers/index.html.twig', [
            'items' => $offeredanswers,
            'formend' => $formend->createView()
        ]);
    }
}
