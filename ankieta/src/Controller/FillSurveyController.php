<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FillSurveyController extends Controller
{
    public function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    /**
     * @Route("/survey/{id}", name="fill_survey")
     */
    public function index($id, SessionInterface $session)
    {
        if(!$session->has('security'))
            return $this->redirect('/');
        else
            $session->remove('security');
        $link = generateRandomString().$id;
    }
}
