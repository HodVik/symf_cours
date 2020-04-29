<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/mailer", name="mailer")
     */
    public function index(\Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message('Hello message!'))
            // ->setFrom("viktor.godulian@gmail.com")
            // ->setTo("balamutyaka@gmail.com")
            ->setFrom("send@example.com")
            ->setTo("recipient@example.com")
            ->setBody($this->renderView(
                'mailer/email.html.twig',
                array('name'=>'Robert'), 
                'text/html'
            ));

            $mailer->send($message);

        return $this->render('mailer/index.html.twig', [
            'controller_name' => 'MailerController',
        ]);
    }
}
