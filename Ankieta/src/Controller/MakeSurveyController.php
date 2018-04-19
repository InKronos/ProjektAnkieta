<?php


namespace App\Controller;

use App\Entity\Survery\SurveryData;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MakeSurveyController extends Controller
{
	public function make(Request $request)
	{
		$surverydata = new SurveryData();

		$formsurvery = $this->createFormBuilder($surverydata)
			->add('question', TextType::class)
			->add('jedzwielu', RadioType::class, array(
    			'label'    => '1 z wielu',
    		))
    		->add('wielezwielu', RadioType::class, array(
    			'label'    => 'wiele z wielu',
    		))
    		->add('ocena', RadioType::class, array(
    			'label'    => 'ocena',
    		))
    		->add('otwarte', RadioType::class, array(
    			'label'    => 'otwarte',
    		))
			->add('dodaj', SubmitType::class, array('label' => 'Dalej'))
            ->getForm();
        return $this->render('Survery/renderSurvery.html.twig', array(
            'formsurvery' => $formsurvery->createView(),
        ));
	}
}