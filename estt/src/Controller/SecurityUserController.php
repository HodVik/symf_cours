<?php

namespace App\Controller;

use App\Entity\SecurityUser;
use App\Form\SecurityUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityUserController extends AbstractController
{
    /**
     * @Route("/sigin-up", name="sigin_up")
     */
    public function newSecurityUser(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
       $user = new SecurityUser();

       $regForm = $this->createForm(SecurityUserType::class , $user);
       $regForm->handleRequest($request);

       if($regForm->isSubmitted() && $regForm->isValid()){
           $user->setPassword(
               $passwordEncoder->encodePassword(
                   $user,
                   $regForm->get('password')
                   ->getData())
           );
           $user->setEmail($regForm->get('email')->getData());

           $this->getDoctrine()->getManager()->persist($user);
           $this->getDoctrine()->getManager()->flush();
           return $this->forward('App\Controller\NewsController::newsFeed');
                
       }

       return $this->render('security_user/siginup.html.twig',[
           'regForm' => $regForm->createView(),
       ]);
    }
}
