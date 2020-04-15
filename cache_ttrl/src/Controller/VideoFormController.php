<?php

namespace App\Controller;

use App\Entity\Video;
use App\Form\VideoFormType;
use App\Repository\VideoRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class VideoFormController extends AbstractController
{
    /**
     * @Route("/video/add", name="video_add")
     */
    public function addVideo(Request $request, SluggerInterface $slugger)
    {
        $video = new Video();
        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $videoFile */
            $videoFile = $form->get('file')->getData();
            $originalFilename = pathinfo($videoFile->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$videoFile->guessExtension(); 
            $video->setFile($newFilename);
            try {
                $videoFile->move(
                    $this->getParameter('video_directory'),
                    $newFilename);
            } catch (FileException $e) {
                \dump($e);
            }
            $video->setFile($newFilename);
            $em = $this->getDoctrine()->getManager();
            $em->persist($video);
            $em->flush();
            return $this->redirect($this->generateUrl('video_list'));
        }
        return $this->render('video_form/index.html.twig',[
            'controller_name' => 'VideoFormController',
            'form' => $form->createView(),
        ]);
        
    }

    /**
     * @Route("/video/new", name="video_new")
     */
    public function newVideo(Request $request, SluggerInterface $slugger)
    {
        $video = new Video();
        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            /** @var UploadedFile $videoFile */
            $videoFile = $form->get('file')->getData();
            $originalFilename = pathinfo($videoFile->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$videoFile->guessExtension(); 
            $video->setFile($newFilename);
            try {
                $videoFile->move(
                    $this->getParameter('video_directory'),
                    $newFilename);
            } catch (FileException $e) {
                \dump($e);
            }
            $video->setFile($newFilename);
            $em = $this->getDoctrine()->getManager();
            $em->persist($video);
            $em->flush();
            return $this->redirect($this->generateUrl('video_list'));
        }
        return $this->render('video_form/newvideo.html.twig',[
            'form' => $form->createView(),
        ]);
        
    }

    /**
     * @Route("/video/edit/{id}", name="video_edit")
     */
    public function editVideo(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository(Video::class)->find($id);

        if($video) {
            \dump($video);
        }
        else return $this->redirectToRoute('video_new');

        $form = $this->createForm(VideoFormType::class, $video);
        $form->handleRequest($request);
        //$form->file = $this->getParameter('video_directory').'/'.$video->getFile();

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($video);
            $em->flush();
            return $this->redirect($this->generateUrl('video_list'));
        }

        return $this->render('video_form/index.html.twig', [
            'controller_name' => 'VideoFormController',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/video/list", name="video_list")
     */
    public function listVideo()
    {
        $em = $this->getDoctrine()->getManager();
        $videoList = $em->getRepository(Video::class)->findAll();
        \dump($videoList);
        

        return $this->render('video_form/videolist.html.twig', [
            'videoList' => $videoList,
        ]);
    }
}
