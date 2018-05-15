<?php

namespace App\UI\Controller\UserSide;

use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Application\Command\RebateCode\CreateNewCodeCommand;

class GenerateCodeController extends Controller
{
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function indexAction()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < 28; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $code = 'reb_'.$randomString;

        $Rcode = new CreateNewCodeCommand($code);
        $this->commandBus->handle($Rcode);

        return $this->redirectToRoute("thanks_for_fill_survey");
    }
}
