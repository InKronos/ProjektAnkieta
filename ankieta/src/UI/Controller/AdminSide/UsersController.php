<?php

namespace App\UI\Controller\AdminSide;

use League\Tactician\CommandBus;
use App\Application\Command\User\CreateNewUserCommand;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function indexAction()
    {
        /*$user = new CreateNewUserCommand('admin', 'admin');
        $this->commandBus->handle($user);

        return new Response('Dodany nowy użytkownik');*/
    }
}
