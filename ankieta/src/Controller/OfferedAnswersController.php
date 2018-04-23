<?php

namespace App\Controller;

use App\Entity\OfferedAnswers;
use App\Form\OfferedAnswerType;
use App\Form\EndType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OfferedAnswersController extends Controller
{
    public function index(Request $request, SessionInterface $session)
    {
        $offeredanswerdata = new OfferedAnswers();
        $questiondata = $session->get('question');
        $formoffered = $this->createForm(OfferedAnswerType::class, $offeredanswerdata);
        $formend = $this->createForm(EndType::class);
        $haveAnswer = false;
        $sthIsNeed = false;
        $entityManager = $this->getDoctrine()->getManager();
        $formoffered->handleRequest($request);
        $formend->handleRequest($request);
        if($formoffered->isSubmitted() && $formoffered->isValid())
        {
            $offeredanswerdata->setIdQuestion($questiondata->getId());
            $entityManager->persist($offeredanswerdata);
            $entityManager->flush();
            $haveAnswer = true;
            
        }
        if ($formend->isSubmitted() && $formend->isValid())
        {
            /*if($haveAnswer == false)
                {
                    $sthIsNeed = true;
                }*/
                $session->remove('questiondata');
                return $this->redirectToRoute('make_questions');
        }

        return $this->render('offered_answers/index.html.twig', [
            'formoffered' => $formoffered->createView(),
            'pytanie' => $questiondata,
            'sthIsNeed' => $sthIsNeed,
            'formend' => $formend->createView()
        ]);
    }
}
