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
use Doctrine\ORM\EntityManagerInterface;


class GenerateSurveyType extends AbstractType
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id = $options['id_survey'];
        $questiondata = $this->entityManager
                            ->getRepository(Questions::class)
                            ->findBy(['id_survey' => $id]);
        $builder;
        $x = 1;
        foreach ($questiondata as $question) 
        {
            $typ = $question->getTyp();
            if($typ == 1 || $typ == 2)
            {
                if($typ == 1) 
                {
                    $multiple = false;
                } 
                else 
                {
                    $multiple = true;
                }
                $choices_array = [];
                $offeredanswerdata = $this->entityManager
                                        ->getRepository(OfferedAnswers::class)
                                        ->findBy(['id_question' => $question->getId()]);
                foreach ($offeredanswerdata as $offeredanswer) 
                {
                    $choices_array[$offeredanswer->getContent()] = $offeredanswer->getContent();
                }
                $builder
                    ->add($question->getId(), ChoiceType::class,
                        array('choices' => $choices_array,  
                        'multiple'=>$multiple,'expanded'=>true,
                        'label' => $question->getContent()
                    ));

            }
            else if($typ == 3)
            {
                $builder
                    ->add($question->getId(), ChoiceType::class,
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
                    ->add($question->getId(), TextareaType::class, ['label' => $question->getContent()]
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
        $resolver->setRequired('id_survey');
    }
}