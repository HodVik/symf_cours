<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\TagAwareAdapter;
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
        if(!$posts->isHit()){
            $posts_from_db = ['post1', 'post2', 'post3', 'post4'];
            \dump('connected wuth database...');

            $posts->set(\serialize($posts_from_db));
            $posts->expiresAfter(5);
            $cache->save($posts);
        }

        //$cache->deleteItem('database.get_posts');
        $cache->clear();
        

        \dump(\unserialize($posts->get()));

        return $this->render('cache/index.html.twig', [
            'controller_name' => 'CacheController',
        ]);
    }

    /**
     * @Route("/cache-tag", name="cache_tag")
     */
    public function index1()
    {
        $cache = new TagAwareAdapter(new FilesystemAdapter());

        $acer = $cache->getItem('acer');
        $dell = $cache->getItem('dell');
        $ibm = $cache->getItem('ibm');
        $apple = $cache->getItem('apple');




        if(!$acer->isHit()){
            $acer_from_db = 'acer laptop';
            $acer->set($acer_from_db);
            $acer->tag(['computer','laptop','acer']);
            $cache->save($acer);
            \dump('acer laptop from database ... ');
        }

        if(!$dell->isHit()){
            $dell_from_db = 'acer laptop';
            $dell->set($dell_from_db);
            $dell->tag(['computer','laptop','dell']);
            $cache->save($dell);
            \dump('dell laptop from database ... ');
        }

        if(!$ibm->isHit()){
            $ibm_from_db = 'ibm desktop';
            $ibm->set($ibm_from_db);
            $ibm->tag(['computer','desktop','ibm']);
            $cache->save($ibm);
            \dump('ibm desktop from database ... ');
        }

        if(!$apple->isHit()){
            $apple_from_db = 'apple desktop';
            $apple->set($apple_from_db);
            $apple->tag(['computer','desktop','apple']);
            $cache->save($apple);
            \dump('apple desktop from database ... ');
        }

        //$cache->invalidateTags(['computer']);
        //$cache->invalidateTags(['laptop']);
        $cache->invalidateTags(['desktop']);
        

        \dump($acer->get());
        \dump($dell->get());
        \dump($ibm->get());
        \dump($apple->get());

        return $this->render('cache/index.html.twig', [
            'controller_name' => 'CacheController',
        ]);
    }
}
