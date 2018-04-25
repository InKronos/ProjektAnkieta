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
        $sthIsNeed = false;
        $entityManager = $this->getDoctrine()->getManager();
        $formoffered->handleRequest($request);
        $formend->handleRequest($request);
        if($formoffered->isSubmitted() && $formoffered->isValid())
        {
            $offeredanswerdata->setIdSurvey($questiondata->getIdSurvey());
            $offeredanswerdata->setIdQuestion($questiondata->getId());
            $entityManager->persist($offeredanswerdata);
            $entityManager->flush();
            if(!($session->has('haveOffAns')))
            {
                $session->set('haveOffAns', 'Teraz masz jedną odpowiedz');
            }
            return $this->redirectToRoute('make_offeredanswers');
            
        }
        if ($formend->isSubmitted() && $formend->isValid())
        {
            if(!($session->has('haveOffAns')))
            {
                $sthIsNeed = true;
            }
            else
            {
                return $this->redirectToRoute('show_offans');
            }
                
        }

        return $this->render('offered_answers/index.html.twig', [
            'formoffered' => $formoffered->createView(),
            'pytanie' => $questiondata,
            'sthIsNeed' => $sthIsNeed,
            'formend' => $formend->createView()
        ]);
    }
}
