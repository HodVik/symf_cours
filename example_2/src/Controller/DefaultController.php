<?php

namespace App\Controller;

//use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/home", name="default", name="home")
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    public function mostPopularArticles($count = 3){
        $articles = ['art1','art2','art3','art4'];
        return $this->render('includes/mostPopularArt.html.twig',[
            'articles'=>$articles
        ]);
    }
}
