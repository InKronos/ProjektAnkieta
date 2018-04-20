<?php


namespace App\Controller;

use App\Entity\Survery\SurveryData;
use App\Entity\Questions;
use App\Form\SurveryType;
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
		$formsurvery = $this->createForm(SurveryType::class, $surverydata);
		

        $formsurvery->handleRequest($request);
         
        if ($formsurvery->isSubmitted() && $formsurvery->isValid())
        {

        }
        return $this->render('Survery/renderSurvery.html.twig', array(
            'formsurvery' => $formsurvery->createView(),
        ));
	}
}