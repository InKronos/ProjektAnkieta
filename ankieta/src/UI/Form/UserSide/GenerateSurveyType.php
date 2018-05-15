<?php

namespace App\UI\Form\UserSide;

use App\Application\Query\OfferedAnswer\OfferedAnswerQuery;
use App\Application\Query\Question\QuestionQuery;
use App\Application\Query\Survey\SurveyQuery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;


class GenerateSurveyType extends AbstractType
{

    private $surveyQuery;

    private $questionQuery;

    private $offeredAnswerQuery;

    public function __construct(SurveyQuery $surveyQuery, QuestionQuery $questionQuery, OfferedAnswerQuery $offeredAnswerQuery)
    {
        $this->surveyQuery = $surveyQuery;
        $this->questionQuery = $questionQuery;
        $this->offeredAnswerQuery = $offeredAnswerQuery;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $id = $options['id_survey'];
        $questionData = $this->questionQuery->getManyByIdSurvey($id);
        $builder;
        $x = 1;
        foreach ($questionData as $question)
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
                $offeredanswerData = $this->offeredAnswerQuery->getManyByIdQuestion($question->getId());
                foreach ($offeredanswerData as $offeredanswer)
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