<?php

namespace App\UI\Controller\AdminSide;

use App\Application\Query\User\UserQuery;
use App\UI\Form\AdminSide\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class LoginController extends Controller
{

    private $userQuery;

    private $session;

    public function __construct(UserQuery $userQuery, SessionInterface $session)
    {
        $this->userQuery = $userQuery;
        $this->session = $session;

    }

    public function loginAction(Request $request)
    {
        $formlogin = $this->createForm(LoginType::class);
        $formlogin->handleRequest($request);

        if ($formlogin->isSubmitted() && $formlogin->isValid())
        {
            $users = $this->userQuery->getByLoginAndPassword($formlogin['login']->getData(), $formlogin['password']->getData());
            if(!$users) {
            		
            } else {
                $this->session->set('login', 'yes');
                return $this->redirectToRoute('control_panel');
            }

        }

        return $this->render('Logowanie/renderLogin.html.twig', [
            'form' => $formlogin->createView(),
        ]);
    }
}