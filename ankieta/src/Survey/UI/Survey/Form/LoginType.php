<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LoginType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('login', TextType::class, array('label' => 'Login '))
			->add('password', PasswordType::class, array('label' => 'Hasło '))
			->add('goto', SubmitType::class, array('label' => 'Zaloguj'))
		;
	}
}