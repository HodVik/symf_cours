<?php
namespace App\Services;

use App\Services\MySecondService;


class MyService{

    public $my;  
    public $logger;

    // public function __construct($globalParam, $adminEmail, $param1, $param2){
    //     \dump($globalParam);
    //     \dump($adminEmail);
    //     \dump($param1);
    //     \dump($param2);
    // }
    use OptionalServiceTrait; #__construct be used from OptionalServiceTrait
    public function __construct($service){
        #\dump($service); //null - bicouse lazy load
        $this->secServ = $service;

        #\dump($secondService);
    }

    public function someAction(){
        \dump($this->service->doSomething());
    }

    public function loggerMy(){
        \dump($this->my);
        \dump($this->logger);
    }

   
    #autowire: true
    // public function __construct(MySecondService $secondService){
    //     #\dump($secondService);
    // }

    #If the service has been registeredwe can use this option 
    // public function __construct($secondService){ 
    //     #\dump($secondService);
    // }

}
?>