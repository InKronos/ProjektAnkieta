<?php


namespace App\UI\Controller;

use App\Application\Command\Survey\CreateNewSurveyCommand;
use App\UI\Form\SurveyType;
use League\Tactician\CommandBus;
use App\Application\Query\Survey\SurveyQuery;
use App\Application\Query\OfferedAnswer\OfferedAnswerQuery;
use App\Application\Query\Question\QuestionQuery;
use App\Application\Query\Answer\AnswerQuery;
use App\Application\Command\OfferedAnswer\DeleteOfferedAnswerCommand;
use App\Application\Command\Answer\DeleteAnswerCommand;
use App\Application\Command\Question\DeleteQuestionCommand;
use App\Application\Command\Survey\DeleteSurveyCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MakeSurveyController extends Controller
{
    private $commandBus;

    private $surveyQuery;

    private $questionQuery;

    private $offeredAnswerQuery;

    private $answerQuery;

    public function __construct(CommandBus $commandBus, SurveyQuery $surveyQuery, QuestionQuery $questionQuery, OfferedAnswerQuery $offeredAnswerQuery, AnswerQuery $answerQuery)
    {
        $this->commandBus = $commandBus;
        $this->surveyQuery = $surveyQuery;
        $this->questionQuery = $questionQuery;
        $this->offeredAnswerQuery = $offeredAnswerQuery;
        $this->answerQuery = $answerQuery;
    }

    public function addAction(Request $request)
    {
        $formsurvey = $this->createForm(SurveyType::class);
        $formsurvey->handleRequest($request);
        
        if ($formsurvey->isSubmitted() && $formsurvey->isValid())
        {
            $name = $formsurvey["name"]->getData();

            $command = new CreateNewSurveyCommand($name);
            $this->commandBus->handle($command);

            $survey = $this->surveyQuery->getByName($name);
            return $this->redirectToRoute('add_question', ['option' => 'new', 'id' => $survey->getId()]);
        }

        return $this->render('survey/renderSurvey.html.twig', [
            'formsurvey' => $formsurvey->createView(),
        ]);
    }

    public function deleteAction($id)
    {
        $surveyData = $this->surveyQuery->getById($id);
        $questionData = $this->questionQuery->getManyByIdSurvey($id);
        $answerData = $this->answerQuery->getManyByIdSurvey($surveyData->getId());

        foreach ($questionData as $question)
        {
            $offeredanswersData = $this->offeredAnswerQuery->getManyByIdQuestion($question->getId());
            foreach ($offeredanswersData as $offeredanswer) {
                $command = new DeleteOfferedAnswerCommand($offeredanswer->getId());
                $this->commandBus->handle($command);
            }
            $command = new DeleteQuestionCommand($question->getId());
            $this->commandBus->handle($command);
        }

        foreach ($answerData as $answer) {
            $command = new DeleteAnswerCommand($answer->getId());
            $this->commandBus->handle($command);
        }
        $command = new DeleteSurveyCommand($surveyData->getId());
        $this->commandBus->handle($command);

        return $this->redirectToRoute('show_surveys');
    }

    public function thanksAction($id)
    {
        $id_survey = $id;
        $questionData = $this->questionQuery->getManyByIdSurvey($id_survey);
        $surveyData = $this->surveyQuery->getById($id_survey);


        return $this->render('you_made_survey/index.html.twig', [
            'items' => $questionData,
            'survey' => $surveyData,
        ]);
    }
}