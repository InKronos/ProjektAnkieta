<?php
namespace App\UI\Controller\AdminSide;

use App\UI\Form\AdminSide\PickOneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class ControlPanelController extends Controller
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function indexAction(Request $request)
    {
        if(!($this->session->has('login'))) {
            return $this->redirectToRoute('main_page');
        }

        $formpanel = $this->createForm(PickOneType::class);
        $formpanel->handleRequest($request);

        if ($formpanel->isSubmitted() && $formpanel->isValid())
        {
            if($formpanel['choice']->getData() == 1) {
                return $this->redirectToRoute('add_survey');
            } elseif ($formpanel['choice']->getData() == 2) {
                return $this->redirectToRoute('show_surveys');
            } else {
                return $this->redirectToRoute('show_table_answers');
            }
        }

        return $this->render('controlPanel/renderPanel.html.twig', [
            'formpanel' => $formpanel->createView(),
        ]);

    }
}