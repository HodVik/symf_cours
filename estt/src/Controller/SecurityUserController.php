<?php

namespace App\Controller;

use App\Entity\SecurityUser;
use App\Form\SecurityUserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
