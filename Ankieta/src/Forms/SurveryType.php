<?php

namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SurveryType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('question', TextType::class)
			->add('typ', ChoiceType::class,
    			array('choices' => array(
                    '1 z wielu' => '1',
                    'wiele z wielu' => '2',
                    'ocena' => '3',
                    'otwarte' => '4'),
            	'choices_as_values' => true,'multiple'=>false,'expanded'=>true))
			->add('dodaj', SubmitType::class, array('label' => 'Dalej'))
		;
	}
}
