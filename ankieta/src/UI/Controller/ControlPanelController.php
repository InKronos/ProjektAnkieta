<?php
namespace App\UI\Controller;

use App\UI\Form\PickOneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ControlPanelController extends Controller
{
    public function indexAction(Request $request)
    {
        $formpanel = $this->createForm(PickOneType::class);
        $formpanel->handleRequest($request);

        if ($formpanel->isSubmitted() && $formpanel->isValid())
        {
            if($formpanel['choice']->getData() == 1) {
                return $this->redirectToRoute('add_survey');
            } elseif ($formpanel['choice']->getData() == 2) {
                return $this->redirectToRoute('show_surveys');
            } else {
               // return $this->redirectToRoute('show_table_answers');
            }
        }

        return $this->render('controlPanel/renderPanel.html.twig', [
            'formpanel' => $formpanel->createView(),
        ]);

    }
}