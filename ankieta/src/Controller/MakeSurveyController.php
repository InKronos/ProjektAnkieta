<?php


namespace App\Controller;

use App\Entity\Survey;
use App\Entity\Questions;
use App\Entity\Answers;
use App\Entity\OfferedAnswers;
use App\Form\QuestionType;
use App\Form\SurveyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MakeSurveyController extends Controller
{

    public function addAction(Request $request, SessionInterface $session)
    {
        $surveydata = new Survey();
        $surveydata->setName('Ankieta dla ...');
        $formsurvey = $this->createForm(SurveyType::class, $surveydata);
        $questiondata = new Questions();
        $entityManager = $this->getDoctrine()->getManager();
        $formsurvey->handleRequest($request);
        
        if ($formsurvey->isSubmitted() && $formsurvey->isValid())
        {
            $session->set('IamNew', 'jestem nową ankietą');
            $entityManager->persist($surveydata);
            $entityManager->flush();
            return $this->redirect('/question/add/'.($surveydata->getId()));
        }
        return $this->render('survey/renderSurvey.html.twig', array(
            'formsurvey' => $formsurvey->createView(),
        ));
    }
     /**
     * @Route("/survey/delete/{id}", name="delete_survey")
     */
    public function deleteAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $survey = $entityManager
                       ->getRepository(Survey::class)
                       ->find($id);
        $questiondata = $entityManager
                           ->getRepository(Questions::class)
                           ->findBy(['id_survey' => $id]);
        $answerdata = $entityManager
                        ->getRepository(Answers::class)
                        ->findBy(['id_survey' => $id]);
        foreach ($questiondata as $question) 
        {
            $offeredanswersdata = $entityManager
                                    ->getRepository(OfferedAnswers::class)
                                    ->findBy(['id_question' => $question->getId()]);
            foreach ($offeredanswersdata as $answer) 
            {
                $entityManager->remove($answer);
            }
            $entityManager->remove($question);
        }
        foreach ($answerdata as $answer)
        {
            $entityManager->remove($answer);
        }
        $entityManager->remove($survey);
        $entityManager->flush();
        return $this->redirect('/show/survey');
    }
}