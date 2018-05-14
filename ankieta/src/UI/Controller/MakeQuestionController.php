<?php

namespace App\UI\Controller;

use App\Application\Command\Question\CreateNewQuestionCommand;
use App\Application\Command\OfferedAnswer\DeleteOfferedAnswerCommand;
use App\Application\Command\Question\DeleteQuestionCommand;
use App\Application\Command\Question\UpdateQuestionCommand;
use App\UI\Form\QuestionType;
use League\Tactician\CommandBus;
use App\Application\Query\Survey\SurveyQuery;
use App\Application\Query\Question\QuestionQuery;
use App\Application\Query\OfferedAnswer\OfferedAnswerQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MakeQuestionController extends Controller
{
    private $commandBus;

    private $surveyQuery;

    private $questionQuery;

    private $offeredAnswerQuery;

    public function __construct(CommandBus $commandBus, SurveyQuery $surveyQuery, QuestionQuery $questionQuery, OfferedAnswerQuery $offeredAnswerQuery)
    {
        $this->commandBus = $commandBus;
        $this->surveyQuery = $surveyQuery;
        $this->questionQuery = $questionQuery;
        $this->offeredAnswerQuery = $offeredAnswerQuery;
    }

    public function addAction($id, $option, Request $request)
    {
        $formQuestion = $this->createForm(QuestionType::class);
        $formQuestion->handleRequest($request);
        $surveyData = $this->surveyQuery->getById($id);

        $questionData = $this->questionQuery->getByIdSurvey($id);
        if($questionData->getId() == 'nothing'){
            $haveQue = false;
        } else {
            $haveQue = true;
        }

        if ($formQuestion->isSubmitted() && $formQuestion->isValid())
        {
            $command = new CreateNewQuestionCommand($id, $formQuestion['content']->getData(), $formQuestion['typ']->getData());
            $this->commandBus->handle($command);

            $questionData = $this->questionQuery->getOneByIdSurveyAndContent($id, $formQuestion['content']->getData());

            if($questionData->getTyp() == 1 || $questionData->getTyp() == 2)
            {
                if($option == 'new'){
                    return $this->redirectToRoute('add_offered_answer', ['option' => 'addToNew', 'id' => $questionData->getId()]);
                } else{
                    return $this->redirectToRoute('add_offered_answer', ['option' => 'addToOld', 'id' => $questionData->getId()]);
                }
            }
            else
            {
                if($option == 'new'){
                    return $this->redirectToRoute('add_question', ['id' => $surveyData->getId()]);
                } else{
                    return $this->redirectToRoute('show_survey_questions', ['id' => $id]);
                }
            }
        }

        return $this->render('make_question/addQuestion.html.twig', [
                'formQuestion' => $formQuestion->createView(),
                'artykul' => $surveyData,
                'haveQue' => $haveQue,
                'option' => $option
            ]);
    }

    public function deleteAction($id)
    {
        $questionData = $this->questionQuery->getById($id);
        $offeredanswersData = $this->offeredAnswerQuery->getManyByIdQuestion($questionData->getId());

        foreach ($offeredanswersData as $offeredanswer) {
            $command = new DeleteOfferedAnswerCommand($offeredanswer->getId());
            $this->commandBus->handle($command);
        }
        $id_survey = $questionData->getIdSurvey();
        $command = new DeleteQuestionCommand($questionData->getId());
        $this->commandBus->handle($command);




        return $this->redirectToRoute('show_survey_questions', [ 'id' => $id_survey]);
    }

    public function editAction($id, Request $request)
    {
        $formQuestion = $this->createForm(QuestionType::class);
        $formQuestion->handleRequest($request);

        $questionData = $this->questionQuery->getById($id);

        if ($formQuestion->isSubmitted() && $formQuestion->isValid())
        {
            $command = new UpdateQuestionCommand($id, $formQuestion['content']->getData(), $formQuestion['typ']->getData());
            $this->commandBus->handle($command);

            $questionData = $this->questionQuery->getById($id);

            if($questionData->getTyp() == 1 || $questionData->getTyp() == 2)
            {
                return $this->redirectToRoute('add_offered_answer', ['option' => 'addToOld', 'id' => $questionData->getId()]);
            }
            else
            {
                return $this->redirectToRoute('show_survey_questions', ['id' => $questionData->getIdSurvey()]);
            }
        }

        return $this->render('make_question/editQuestion.html.twig', [
            'formQuestion' => $formQuestion->createView(),
            'question' => $questionData,
        ]);
    }

}
