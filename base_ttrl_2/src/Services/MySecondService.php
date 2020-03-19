<?php
namespace App\Services;

class MySecondService{

    

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
        return 'hello! from MySecondService';
    }
}
?>