<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Video;
use App\Entity\Address;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/create/{name}", name="create")
     */
    public function create($name)
    {
        $user = new User();
        $user->setName($name);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        
        \dump('A new user was saved with id of '.$user->getId());
        \dump('A street where live user called '.$user->getAddress()->getStreet());


        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/read", name="read")
     */
    public function read(UserRepository $userRepository)
    {
       // $repository = $this->getDoctrine()->getRepository(User::class);
        //$user = $repository->find(1);
        //$user = $repository->findOneBy(['Name'=>'Barry']);
        //$user = $repository->findOneBy(['Name'=>'Barry', 'id'=>'6']);
        //$users = $repository->findBy(['Name'=>'Barry'],['id'=>'DESC'],3);
        $users = $userRepository->findAll();


        \dump($users);

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

     /**
     * @Route("/update", name="update")
     */
    public function update()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $id = 1;

        $user = $entityManager->getRepository(User::class)->find($id);

        if(!$user){
            throw $this->createNotFoundException('User is not found');
        }

        $user->setName('Albert');
        $entityManager->persist($user);
        $entityManager->flush();

        \dump($user);

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/delete/{name}", name="delete")
     */
    public function delete($name)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $entityManager->getRepository(User::class)->findOneBy(['Name'=>$name]);
        $entityManager->remove($user);
        $entityManager->flush();

        \dump($user);

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/select", name="select")
     */
    public function select(UserRepository $userRepository)
    {
        \dump($userRepository->findWithVideo(2));
        //$em = $this->;

        // $conn = $this->getDoctrine()->getManager()->getConnection();
        // $sql = '
        // select * from user u
        // where u.id < :id or u.Name like :name
        // ';
        // $stmt = $conn->prepare($sql);
        // $stmt->execute(['id'=>3, 'name'=>'Albert']);

        // \dump($stmt->fetchAll());

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/get/{id}", name="get_by_id")
     */
    public function getById(User $user)
    {
        \dump($user);

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    /**
     * @Route("/add-videos/{name}", name="addVideos")
     */
    public function addVideos($name)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['Name'=>$name]);
        for($i = 0; $i < 3; $i++){
            $video = new Video();
            $video->setTitle("Video - $i");
            $video->setUser($user);
            $entityManager->persist($video);
        }
        //$entityManager->persist($user);
        $entityManager->flush();
        \dump($this->getDoctrine()->getRepository(Video::class)->findAll());
        \dump( $user );

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    /**
     * @Route("/find-videos/{name}", name="findVideos")
     */
    public function findVideo($name)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['Name'=>$name]);

        #\dump($this->getDoctrine()->getRepository(Video::class)->findBy(['user'=> $user]));

        foreach($user->getVideos() as $video)
            \dump($video);

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
