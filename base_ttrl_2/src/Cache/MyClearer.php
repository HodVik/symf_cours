<?php
// src/Cache/MyClearer.php
namespace App\Cache;

use Symfony\Component\HttpKernel\CacheClearer\CacheClearerInterface;

class MyClearer implements CacheClearerInterface
{
    public function clear($cacheDirectory)
    {
        // clear your cache
        \dump("cachClear: hello there");
    }
}

?>