<?php

namespace App\Controller;

use App\Entity\User;
use App\Services\GiftsService;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends AbstractController
{
    private $logger;

    public function __construct($logger){
        $this->logger = $logger;
    }

    /**
     * @Route("/home")
     */
    public function home(){
        return $this->render('default/index1.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/", name="default")
     */
    public function index(GiftsService $gifts, Request $request, SessionInterface $session)
    {
        $this->logger->info('loger wos bind from .yaml');
        #region data example
        //return new Response("Hello") ;

        // $users = ['Adam', 'John', 'Berta', 'Susan'];
        // $users[2] = 'Bertruda';

        // $entityManager = $this->getDoctrine()->getManager();

        // $user = new User;
        // $user->setName('Adam');
        // $entityManager->persist($user);

        // $user2 = new User;
        // $user2->setName('Berta');
        // $entityManager->persist($user2);

        // $user3 = new User;
        // $user3->setName('John');
        // $entityManager->persist($user3);

        // $user4 = new User;
        // $user4->setName('Susan');
        // $entityManager->persist($user4);

        // exit($entityManager->flush());
        #endregion
        
        #region flash message
        // $this->addFlash(
        //     'notice',
        //     'Your changes were saved'
        // );

        // $this->addFlash(
        //     'warning',
        //     'Your changes weren`t saved'
        // );
        #endregion

        #region Cookies
        // $cookie = new Cookie(
        //     'my_cookie',        //cookie name
        //     'cookie value',     //cookie value
        //     time() + (2 * 365 * 24 * 60 * 60) //expries after 2 year
        // );

        
        // $res = new Response();
        // $res->headers->setCookie($cookie);
        // $res->send();

        
        // $res = new Response();
        // $res->headers->clearCookie('my_cookie');
        // $res->send();
        // if ($request->cookies->has('my_cookie')) {
        //     exit($request->cookies->remove('my_cookie'));
        // }

        // if ($request->cookies->has('PHPSESSID')) {
        //     exit($request->cookies->get('PHPSESSID'));
        // }
        
        #endregion
        
        #region Session
        // $session->set('my_session','session value');
        // if($session->has('my_session')){
        //     exit($session->get('my_session').'   '.$request->cookies->get('PHPSESSID'));
        // }
        #endregion

        //exit($request->query->get('page','default'));
        //exit($request->server->get('REMOTE_HOST'));


        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        // if($users){
        //     throw $this->createNotFoundException('Not found');
        // }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'users' => $users,
            'random_gift' => $gifts->gifts,
        ]);
    }

    /**
     * @Route("/blog/{page?}", name="blog_list", requirements={"page"="\d+"})
     */
    public function index2(){
        return new Response('Optional parameters in url and requirements for parameters');
    }

    /**
     * @Route(
     *  "/articles/{_local}/{year}/{slug}/{category}",
     *  defaults={"categoty":"computers"}, 
     *  requirements={
     *      "_local"="en|fr",
     *      "year"="\d+",
     *      "category"="computers|rtv" 
     *  }
     * )
     */

    public function index3(){
        return new Response('An advanced rout example');
    }

    /**
     * @Route({
     *      "nl":"/over-ons",
     *      "en":"/about-us"
     * },name="about_us")
     */
    public function index4(){
        return new Response('Translated rout');
    }

    /**
     * @Route("/generate-url/{page?}", name="generate_url")
     */
    public function generate_url(){
        exit($this->generateUrl(
            "generate_url",
            array('param' => 10),
            UrlGeneratorInterface::ABSOLUTE_URL
        ));
    }

    /**
     * @Route("/download/{file_name}", name="download_file")
     */
    public function download($file_name){
        $path = $this->getParameter('download_directory');
        return $this->file($path."$file_name.txt");
    }

    /**
     * @Route("/redirect/{param?}")
     */
    public function testRedirect($param = '')
    {
        return $this->redirectToRoute('route_to_redirect',
            array('param'=>$param)
        ); 
    }

    /**
     * @Route("/redirect-to-route/{param?}", name="route_to_redirect")
     */
    public function methodToRedirect($param){
        exit("Test to redirect $param");
    }

    /**
     * @Route("/forwarding-to-controller")
     */
    public function forwardingToController(){
        $respons = $this->forward(
            'App\Controller\DefaultController::methodeToForwardTo',
            array('param'=>1)
        );
    }

     /**
     * @Route("/url-to-forvard-to/{param?}", name="route_to_forvard_to")
     */
    public function methodeToForwardTo($param){
        exit("Test contrller forvarding $param");
    }
}
