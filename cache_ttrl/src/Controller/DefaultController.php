<?php

namespace App\Controller;

use App\Entity\Video;
use App\Events\VideoCreatedEvent;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DefaultController extends AbstractController
{

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @Route("/default", name="default")
     */
    public function index()
    {
        $video = new \stdClass();
        $video->title = 'funy video';
        $video->category = 'funy';

        $event = new VideoCreatedEvent($video);
        $this->dispatcher->dispatch($event, 'video.created.event');

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/form", name="default_form")
     */
    public function index1()
    {
        $video = new Video();
        $video->setTitle('funy blog video');
        $video->setCategory('funy');
        $video->setCreatedAt(new \DateTime('tomorrow'));

        $event = new VideoCreatedEvent($video);
        $this->dispatcher->dispatch($event, 'video.created.event');

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
