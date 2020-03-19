<?php

namespace App\Controller;

use App\Services\MyService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(MyService $ms)
    {
        // $ms->someAction();
        // $ms->loggerMy();

        \dump($ms->secServ->sayHello());

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
