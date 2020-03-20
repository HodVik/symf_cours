<?php
namespace App\Services;

use App\Interfaces\ServiceInterface;

class MySecondService implements ServiceInterface{

    

    public function __construct()
    {
        \dump('This friendly message is coming from MySecondService');
    }

    public function doSomething()
    {
        return 'wow!';
    }
    public function sayHello()
    {
        return 'Hello! from MySecondService';
    }
}
?>