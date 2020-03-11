<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Address;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddressController extends AbstractController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
    /**
     * @Route("/create/address/{user_name}/{street}/{number}")
     */
    public function create($user_name, $street, $number)
    {
        $address = new Address();
        $address->setStreet($street);
        $address->setNumber($number);
        $user = $this->userRepository->findOneByName($user_name);
        $user->setAddress($address);
        $this->getDoctrine()->getManager()->persist($user);
        $this->getDoctrine()->getManager()->flush();

        //$this->getDoctrine()->getManager()->persist($address);// required if 'cascade: persist' is not set

        \dump('User id '.$user->getId());
        \dump('Street '.$user->getAddress()->getStreet().' '.$user->getAddress()->getNumber());
        return $this->render('address/index.html.twig', [
            'controller_name' => 'AddressController',
        ]);
    }

    /**
     * @Route("/read/address/{user_name}", name="get_address")
     */
    public function readAddress($user_name){
        $user =$this->userRepository->findOneByName($user_name);
        \dump($user->getAddress()->getStreet());
        \dump($user->getAddress()->getNumber());


        return $this->render('address/index.html.twig', [
            'controller_name' => 'AddressController',
        ]);
    }

    /**
     * @Route("/delete/address/{street}/{number}", name="delete_addres")
     */
    // public function deleteAdress($street, $number){

    //     $address = $this->getDoctrine()->getRepository(Address::class)->findOneBy([
    //         'street'=>$street, 
    //         'number'=>$number]);
    //     $this->getDoctrine()->getManager()->remove($address);
    //     $this->getDoctrine()->getManager()->flush();

    //     \dump($address);
    // }
}
