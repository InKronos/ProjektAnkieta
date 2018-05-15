<?php

namespace App\UI\Controller\AdminSide;

use App\UI\Form\AdminSide\OfferedAnswerType;
use League\Tactician\CommandBus;
use App\Application\Command\OfferedAnswer\CreateNewOfferedAnswerCommand;
use App\Application\Query\OfferedAnswer\OfferedAnswerQuery;
use App\Application\Query\Question\QuestionQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OfferedAnswerController extends Controller
{
    private $commandBus;

    private $questionQuery;

    private $offeredAnswerQuery;

    private $session;

    public function __construct(CommandBus $commandBus, QuestionQuery $questionQuery, OfferedAnswerQuery $offeredAnswerQuery, SessionInterface $session)
    {
        $this->commandBus = $commandBus;
        $this->questionQuery = $questionQuery;
        $this->offeredAnswerQuery = $offeredAnswerQuery;
        $this->session = $session;
    }

    public function addAction($option ,$id, Request $request)
    {
        if(!($this->session->has('login'))) {
            return $this->redirectToRoute('main_page');
        }

        $id_question = $id;
        $questionData = $this->questionQuery->getById($id_question);

        $formoffered = $this->createForm(OfferedAnswerType::class);
        $formoffered->handleRequest($request);

        $offeredAnswerData = $this->offeredAnswerQuery->getByIdQuestion($id_question);
        if($offeredAnswerData->getId() == 'nothing'){
            $haveQue = false;
        } else {
            $haveQue = true;
        }

        if($formoffered->isSubmitted() && $formoffered->isValid())
        {
            $command = new CreateNewOfferedAnswerCommand($id_question, $formoffered['content']->getData());
            $this->commandBus->handle($command);

            return $this->redirectToRoute('add_offered_answer', ['option' => $option, 'id' => $id_question]);

        }

        return $this->render('offered_answers/index.html.twig', [
            'formoffered' => $formoffered->createView(),
            'questionData' => $questionData,
            'haveQue' => $haveQue,
            'option' => $option,
        ]);
    }

    public function thanksAction($option, $id)
    {
        if(!($this->session->has('login'))) {
            return $this->redirectToRoute('main_page');
        }

        $id_question = $id;
        $questionData = $this->questionQuery->getById($id_question);
        $offeredAnswersData = $this->offeredAnswerQuery->getManyByIdQuestion($id_question);

        return $this->render('show_offered_answers/index.html.twig', [
            'items' => $offeredAnswersData,
            'option' => $option,
            'question' => $questionData,
        ]);
    }

}