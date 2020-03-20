<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CacheController extends AbstractController
{
    /**
     * @Route("/cache", name="cache")
     */
    public function index()
    {
        return $this->render('cache/index.html.twig', [
            'controller_name' => 'CacheController',
        ]);
    }
}
