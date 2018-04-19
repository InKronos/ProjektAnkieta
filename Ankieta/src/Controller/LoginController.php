<?php

namespace App\Controller;

use App\Entity\Logowanie\LoginData;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LoginController extends Controller
{
	public function logowanie(Request $request)
	{
		$logindata = new LoginData();

		$formlogin = $this->createFormBuilder($logindata)
			->add('login', TextType::class)
			->add('password', PasswordType::class)
			->add('goto', SubmitType::class, array('label' => 'Zaloguj'))
			->getForm();

		$formlogin->handleRequest($request);
		if ($formlogin->isSubmitted() && $formlogin->isValid()) {
        	$login = $logindata->getLogin();
        	$password = $logindata->getPassword();
			if($login == "admin" && $password == "admin"){
				return $this->redirectToRoute('login_success');
			}
			
			/*else{
				return (
					'<span style="color:red">Zły login lub haslo</span>')
			}*/
        
    }
		return $this->render('Logowanie/renderLogin.html.twig', 
			array('form' => $formlogin->createView(), 
		));
	}
}