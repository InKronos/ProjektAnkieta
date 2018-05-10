<?php

namespace App\UI\Controller;

use App\UI\Form\OfferedAnswerType;
use League\Tactician\CommandBus;
use App\Application\Query\Survey\OfferedAnswerQuery;
use App\Application\Query\Question\QuestionQuery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MakeOfferedAnswerController extends Controller
{
    private $commandBus;

    private $questionQuery;

    private $offeredAnswerQuery;

    public function __construct(CommandBus $commandBus, QuestionQuery $questionQuery, OfferedAnswerQuery $offeredAnswerQuery)
    {
        $this->commandBus = $commandBus;
        $this->questionQuery = $questionQuery;
        $this->offeredAnswerQuery = $offeredAnswerQuery;
    }

    public function addAction($option ,$id, Request $request)
    {
        $id_question = $id;

        $formoffered = $this->createForm(OfferedAnswerType::class);
        $formoffered->handleRequest($request);


        if($formoffered->isSubmitted() && $formoffered->isValid())
        {

            //return $this->redirect('/question/answer/add/'.$id);
            
        }


        return $this->render('offered_answers/index.html.twig', [
            'formoffered' => $formoffered->createView(),
            'pytanie' => $questiondata,
        ]);
    }
}