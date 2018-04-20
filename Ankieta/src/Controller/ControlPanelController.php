<?php
namespace App\Controller;

use App\Entity\Choices;
use App\Form\PickOneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ControlPanelController extends Controller
{
    public function index(Request $request)
    {
        $choice = new Choices();
        $formpanel = $this->createForm(PickOneType::class, $choice);
        
        $formpanel->handleRequest($request);

        if ($formpanel->isSubmitted() && $formpanel->isValid())
        {
            if($choice->getChoice() == 1)
            {
                return $this->redirectToRoute('make_survey');
            }
        }
        return $this->render('controlPanel/renderPanel.html.twig', 
            array('formpanel' => $formpanel->createView(), 
        ));

    }
}