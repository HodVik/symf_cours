<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        //$users = ['Adam', 'Serg', 'Eve'];

        // $entityManager = $this->getDoctrine()->getManager();
        // $user = new User();
        // $user->setName('Adam');
        // $entityManager->persist($user);

        // $user2 = new User();
        // $user2->setName('John');
        // $entityManager->persist($user2);

        // $user3 = new User();
        // $user3->setName('Jule');
        // $entityManager->persist($user3);

        // $user4 = new User();
        // $user4->setName('Suse');
        // $entityManager->persist($user4);

        // exit($entityManager->flush());

        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
        ]);
    }

    /**
     * @Route("/test", name="test")
     */
    public function index1()
    {
        \dump('abc123');
        return $this->render('user/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
