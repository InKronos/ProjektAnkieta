<?php

namespace App\Controller;

use App\Entity\OfferedAnswers;
use App\Entity\Questions;
use App\Form\OfferedAnswerType;
use App\Form\EndType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OfferedAnswersController extends Controller
{
     /**
     * @Route("/question/answer/{option}/{id}", name="answer_add")
     */
    public function index($option ,$id, Request $request, SessionInterface $session)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $offeredanswerdata = new OfferedAnswers();
        $id_question = $id;
        $questiondata = $entityManager
                            ->getRepository(Questions::class)
                            ->find($id_question);
        $formoffered = $this->createForm(OfferedAnswerType::class, $offeredanswerdata);
        $formend = $this->createForm(EndType::class);
        $sthIsNeed = false;
        $formoffered->handleRequest($request);
        $formend->handleRequest($request);
        if($formoffered->isSubmitted() && $formoffered->isValid())
        {
            $offeredanswerdata->setIdSurvey($questiondata->getIdSurvey());
            $offeredanswerdata->setIdQuestion($questiondata->getId());
            $entityManager->persist($offeredanswerdata);
            $entityManager->flush();
            return $this->redirect('/question/answer/add/'.$id);
            
        }
        if ($formend->isSubmitted() && $formend->isValid())
        {
            $HowManyAnswers = $entityManager
                            ->getRepository(OfferedAnswers::class)
                            ->findBy(['id_question' => $id_question]);
            if(!$HowManyAnswers)
            {
                $sthIsNeed = true;
            }
            else
            {
                return $this->redirect('/question/answer/'.$option.'/thanks/'.$id);
            }
                
        }

        return $this->render('offered_answers/index.html.twig', [
            'formoffered' => $formoffered->createView(),
            'pytanie' => $questiondata,
            'sthIsNeed' => $sthIsNeed,
            'formend' => $formend->createView()
        ]);
    }
    /**
     * @Route("/question/answer/{option}/thanks/{id}", name="answer_thanks_add")
     */
    public function showAction($option, $id, Request $request, SessionInterface $session)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $id_question = $id;
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
            if($option == 'edit')
            {
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
