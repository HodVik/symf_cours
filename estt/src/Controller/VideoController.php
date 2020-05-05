<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
    /**
     * @Route("/newVideo", name = "newvideo")
     */
    public function newVideo(Type $var = null)
    {
        # code...
    }












    /**
     * @Route("/video", name="video")
     */
    public function index()
    {
        return $this->render('video/index.html.twig', [
            'controller_name' => 'VideoController',
        ]);
    }
}
