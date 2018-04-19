<?php

namespace App\Controller;
use App\Entity\Users;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Flex\Response;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    /**
     * @Route("/users", name="users")
     */
    public function index()
    {
        /*return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);*/
        $entityManager = $this->getDoctrine()->getManager();
        
        $user = new Users();
        $user->setLogin('admin');
        $user->setPassword('admin');
        $user->setEmail('admin@admin.org');

        $entityManager->persist($user);
         $entityManager->flush();
        return new Response('Dodany nowy użytkownik z id '.$user->getId());
    }
}
