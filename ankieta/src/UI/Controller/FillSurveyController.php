<?php

namespace App\UI\Controller;

use App\UI\Form\GenerateSurveyType;
use App\Application\Command\Answer\CreateNewAnswerCommand;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class FillSurveyController extends Controller
{
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /*
    public function index($id, SessionInterface $session)
    {
        $surveydata = $this->getDoctrine()
            ->getRepository(Survey::class)
            ->find($id);
        if(!$surveydata) {
            return $this->redirect('/');
        }

        if(!$session->has('security')) {
            return $this->redirect('/');
        } else {
            $session->remove('security');
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $link = $randomString.$id;

        return $this->redirect('/survey/fill/'.$link);
    }*/
    public function fillAction($id, Request $request)
    {
        $form = $this->createForm(GenerateSurveyType::class, null, array('id_survey' => $id));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) 
        {
                $command = new CreateNewAnswerCommand($id, $form->getData());
                $this->commandBus->handle($command);

                return $this->redirectToRoute("thanks_for_fill_survey");
        }

        return $this->render('fill_survey/index.html.twig', [
                'form' => $form->createView(),
            ]);
    }

    public function thanksAction()
    {

        //$Rcode =


        return $this->render('fill_survey/thanks.html.twig', [
            //'rebate' => $Rcode
        ]);



    }

}
