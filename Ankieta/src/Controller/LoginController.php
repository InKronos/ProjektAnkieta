<?php

namespace App\Controller;

use App\Entity\LoginData;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LoginController extends Controller
{
	public function new(Request $request)
	{
		$logindata = new LoginData();

		$formlogin = $this->createFormBuilder($logindata)
			->add('login', TextType::class)
			->add('password', PasswordType::class)
			->add('goto', SubmitType::class, array('label' => 'Zaloguj'))
			->getForm();


		if ($formlogin->isSubmitted() && $formlogin->isValid()) {
        
			if($formlogin->getlogin() == "admin" && $formlogin->getpassword() == "admin"){
				
			}
			return $this->redirect('http://symfony.com/doc');
			/*else{
				return (
					'<span style="color:red">Zły login lub haslo</span>')
			}*/
        
    }
		return $this->render('new.html.twig', 
			array('form' => $formlogin->createView(), 
		));
	}
}