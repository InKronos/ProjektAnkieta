<?php

namespace App\Form;

use App\Entity\Survey;
use App\Entity\Questions;
use App\Entity\OfferedAnswers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\HttpFoundation\Session\Session;


class GenerateSurveyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*global $kernel;

        if ( 'AppCache' == get_class($kernel) )
        {
            $kernel = $kernel->getKernel();
        }
        $doctrine = $kernel->getContainer()->get( 'doctrine' );
        $questiondata = $doctrine
            ->getRepository(Questions::class)
            ->findBy([
                'id_survey' => 5
                ]);
                */
        $session = new Session();
        $questiondata = $session->get('questiondata');
        $offeredanswerdata = $session->get('offeredanswersdata');
        $builder;
        $x = 0;
        foreach ($questiondata as &$question) 
        {
            $typ = $question->getTyp();
            if($typ == 1 || $typ == 2)
            {
                if($typ == 1)
                    $multiple = false;
                else 
                    $multiple = true;
                $choices_array = [];
                foreach ($offeredanswerdata as &$offeredanswer) 
                {
                    if($offeredanswer->getIdQuestion() == $question->getId())
                        $choices_array[$offeredanswer->getContent()] = $offeredanswer->getContent();
                }
                $builder
                    ->add('pytanie'.$x, ChoiceType::class,
                        array('choices' => $choices_array,  
                        'multiple'=>$multiple,'expanded'=>true,
                        'label' => $question->getContent()
                    ));

            }
            else if($typ == 3)
            {
                $builder
                    ->add('pytanie'.$x, ChoiceType::class,
                        array('choices' => array(
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5'),
                        'multiple'=>false,'expanded'=>true,
                        'label' => $question->getContent()
                    ));
            }
            else
            {
                $builder
                    ->add('pytanie'.$x, TextareaType::class, ['label' => $question->getContent()]
                    );
            }
            $x++;
        }
        $builder
            ->add('wyslij', SubmitType::class, ['label' => 'Wyślij'])
            ->add('reset', ResetType::class, ['label' => 'Reset']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}