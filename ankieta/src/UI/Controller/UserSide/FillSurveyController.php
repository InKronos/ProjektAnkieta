<?php

namespace App\UI\Controller\UserSide;

use App\UI\Form\UserSide\GenerateSurveyType;
use App\Application\Command\Answer\CreateNewAnswerCommand;
use App\Application\Command\RebateCode\UpdateCodeCommand;
use App\Application\Query\RebateCode\RebateCodeQuery;
use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class FillSurveyController extends Controller
{
    private $commandBus;

    private $codeQuery;

    public function __construct(CommandBus $commandBus, RebateCodeQuery $codeQuery)
    {
        $this->commandBus = $commandBus;
        $this->codeQuery = $codeQuery;
    }

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

        $Rcode = $this->codeQuery->getNoneUsedCodes();

        if(!$Rcode){
            return $this->redirectToRoute("generate_code");
        } else {
            $command = new UpdateCodeCommand($Rcode->getId());
            $this->commandBus->handle($command);
            return $this->render('fill_survey/thanks.html.twig', [
                'rebate' => $Rcode
            ]);
        }
    }

}
