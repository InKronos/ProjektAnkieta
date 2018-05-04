<?php

namespace App\Controller;

use App\Entity\RebateCode;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GenerateCodeController extends Controller
{
    /**
     * @Route("/generate/code", name="generate_code")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $Rcode = new RebateCode();
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < 28; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $code = 'reb_'.$randomString;
        $Rcode->setCode($code);
        $Rcode->setUsed(false);
        $entityManager->persist($Rcode);
        $entityManager->flush();

        return $this->redirectToRoute("thanks_survey");
    }
}
