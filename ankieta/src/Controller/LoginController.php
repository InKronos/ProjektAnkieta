<?php

namespace App\Controller;

use App\Entity\Logowanie\LoginData;
use App\Entity\Users;
use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class LoginController extends Controller
{

    public function logowanie(Request $request)
    {
        $user = new Users();
        $formlogin = $this->createForm(LoginType::class, $user);
        
        $formlogin->handleRequest($request);
        if ($formlogin->isSubmitted() && $formlogin->isValid())
        {
            $repository = $this->getDoctrine()->getRepository(Users::class);
            $login = $user->getLogin();
            $password = $user->getPassword();
            $users = $repository->findBy(
               array(
               	'login' => $login,
                'password' => $password
            	)
            );
            if(!$users)
            {
            		
            }	
            else
            {
                return $this->redirectToRoute('login_success');
            }

        }
        return $this->render('Logowanie/renderLogin.html.twig', 
            array('form' => $formlogin->createView(), 
        ));
    }
}