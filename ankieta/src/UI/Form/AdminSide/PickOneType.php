<?php

namespace App\UI\Form\AdminSide;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PickOneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('choice', ChoiceType::class,
                array('choices' => array(
                    'Stwórz Ankiete' => '1',
                    'Zobacz Ankiety' => '2',
                    'Zobacz Odpowiedzi do ankiet' => '3'
                ))
            )
            ->add('dalej', SubmitType::class, array('label' => 'wybierz'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
