<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CacheController extends AbstractController
{
    /**
     * @Route("/cache", name="cache")
     */
    public function index()
    {
        $cache = new FilesystemAdapter();

        $posts = $cache->getItem('database.get_posts');
        \dump(\unserialize($posts->get()));

        return $this->render('cache/index.html.twig', [
            'controller_name' => 'CacheController',
        ]);
    }
}
