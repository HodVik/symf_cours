<?php

namespace App\Controller;

use App\Entity\Author;
use App\Services\MyService;
use App\Interfaces\ServiceInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(MyService $ms)
    {
        // $ms->someAction();
        // $ms->loggerMy();

        \dump($ms->secServ->sayHello());

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/alias", name="alias")
     */
    public function index1(ContainerInterface $cf)
    {
        $cf->get('app.myservice');

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/tags", name="tags")
     */
    public function indexTags()
    {
        $em = $this->getDoctrine()->getManager();
        $author = $em->getRepository(Author::class)->find(1);
        $author->setName('Tage');
        $em->persist($author);
        $em->flush();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/service", name="service")
     */
    public function interface(ServiceInterface $service)
    {
        \dump($service->sayHello());

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

}
