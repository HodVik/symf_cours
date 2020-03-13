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

            for ($j=0; $j < 3; $j++) { 
                $pdf = new Pdf();
                $pdf->setFilename("Pdf$j");
                $pdf->setSize(5454);
                if($j%2==0)
                    $pdf->setDescription("brief description of the document");
                $pdf->setOrientation("document");
                $pdf->setPageNumber($i+$j+1);
                $pdf->setAuthor($author);
                $manager->persist($pdf);
            }

            for ($k=0; $k < 2; $k++) { 
                $video = new Video();
                $video->setFilename("Video$k$i");
                $video->setSize(12435);
                $video->setDescription("video about video");
                $video->setFormat("mpeg4");
                $video->setDuration(60*($k+$i+1));
                $video->setAuthor($author);
                $manager->persist($video);
            }

        }

        $manager->flush();
    }
}
