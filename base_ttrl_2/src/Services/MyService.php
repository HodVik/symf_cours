<?php
namespace App\Services;

use App\Services\MySecondService;
use App\Interfaces\ServiceInterface;
use Doctrine\ORM\Event\PostFlushEventArgs;



class MyService implements ServiceInterface{

    #region
    // public $my;  
    // public $logger;

    // public function __construct($globalParam, $adminEmail, $param1, $param2){
    //     \dump($globalParam);
    //     \dump($adminEmail);
    //     \dump($param1);
    //     \dump($param2);
    // }
    // use OptionalServiceTrait; #__construct be used from OptionalServiceTrait
    // public function __construct($service){
    //     #\dump($service); //null - bicouse lazy load
    //     #$this->secServ = $service;// using lazy load
    //     #\dump($secondService);
    // }

    // public function someAction(){
    //     \dump($this->service->doSomething());
    // }

    // public function loggerMy(){
    //     \dump($this->my);
    //     \dump($this->logger);
    // }

   
    #autowire: true
    // public function __construct(MySecondService $secondService){
    //     #\dump($secondService);
    // }

    #If the service has been registeredwe can use this option 
    // public function __construct($secondService){ 
    //     #\dump($secondService);
    // }


    #using service alias
    // public function __construct($one)
    // {
    //     \dump($one);
    //     # code...
    // }
    
    #Service tags
    // public function __construct()
    // {
    //     \dump("Hello tags");
    // }
    #endregion
    public function postFlush(PostFlushEventArgs $args)
    {
        \dump('postFlush: hello to');
        \dump($args);
        # code...
    }

    public function sayHello()
    {
        return 'Hello from MyService';
    }
}
?>