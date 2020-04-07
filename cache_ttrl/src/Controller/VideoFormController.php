<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoFormType;
use App\Repository\VideoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VideoFormController extends AbstractController
{
    /**
     * @Route("/video/add", name="video_add")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        $video = new Video();
        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($video);
            $em->flush();
            return $this->redirectToRoute('video_add');
        }

        if(count($videos = $em->getRepository(Video::class)->findAll()) > 0)
            \dump($videos);
        // $videos = $em->getRepository(Video::class)->findAll();
        // if(count($videos) > 0)
        //     \dump($videos);
            
        return $this->render('video_form/index.html.twig', [
            'controller_name' => 'VideoFormController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/video/edit/{id}", name="video_edit")
     */
    public function edit(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository(Video::class)->find($id);

        if($video) {
            \dump($video);
        }
        else return $this->redirectToRoute('video_add');

        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($video);
            $em->flush();
        }

        return $this->render('video_form/index.html.twig', [
            'controller_name' => 'VideoFormController',
            'form' => $form->createView(),
        ]);
    }
}
