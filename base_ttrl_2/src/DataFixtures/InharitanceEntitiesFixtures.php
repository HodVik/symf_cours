<?php

namespace App\DataFixtures;


use App\Entity\File;
use App\Entity\Video;
use App\Entity\Pdf;
use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class InharitanceEntitiesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        for ($i = 0; $i < 2; $i++){
            $author = new Author();
            $author->setName("Author $i");
            $manager->persist($author);


        }

        $manager->flush();
    }
}
