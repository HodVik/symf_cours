<?php

namespace App\EventSubscriber;

// use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class VideoCreatedSubscriber implements EventSubscriberInterface
{
    public function onVideoCreatedEvent($event)
    {
        \dump($event->video->title);
    }

    public function onKernelResponse(ResponseEvent  $event)
    {
        $response =  new Response('onKernelResponse dupa');
        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return [
            // 'video.created.event' => 'onVideoCreatedEvent',
            // KernelEvents::RESPONSE => 'onKernelResponse'
        ];
    }
}
