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
            if($choice->getChoice() == 1) {
                return $this->redirectToRoute('add_survey');
            } elseif ($choice->getChoice() == 2) {
                return $this->redirectToRoute('show_survey');
            } elseif($choice->getChoice() == 3) {
                return $this->redirectToRoute('show_table_answers');
            }
        }
        return $this->render('controlPanel/renderPanel.html.twig', 
           ['formpanel' => $formpanel->createView(),
        ]);

    }
}