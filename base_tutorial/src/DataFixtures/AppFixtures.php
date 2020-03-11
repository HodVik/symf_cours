<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Video;
use App\Entity\Address;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $fortune = new Address();
        $fortune->setStreet('Fortune');
        $fortune->setNumber(3);

        $eros33 = new Address();
        $eros33->setStreet('Eros');
        $eros33->setNumber(33);

        $eros8 = new Address();
        $eros8->setStreet('Eros');
        $eros8->setNumber(8);

        $cerera = new Address();
        $cerera->setStreet('Cerera');
        $cerera->setNumber(13);

        $adam = new User();
        $adam->setName('Adam');
        $adam->setAddress($eros33);

        $bella = new User();
        $bella->setName('Bella');
        $bella->setAddress($eros8);

        $rosi = new User();
        $rosi->setName('Rosi');
        $rosi->setAddress($cerera);

        $hodvik = new User();
        $hodvik->setName('Hodvik');
        $hodvik->setAddress($fortune);

        $hodvik->addFollowed($rosi);
        $hodvik->addFollowed($bella);

        $bella->addFollowed($rosi);
        $bella->addFollowed($hodvik);
        $bella->addFollowed($adam);

        $manager->persist($adam);
        $manager->persist($bella);
        $manager->persist($rosi);
        $manager->persist($hodvik);

        for($i = 0; $i < 5; $i++){
            if($i < 2){
                $vide1 = new Video();
                $vide1->setTitle('VID_'.\random_int(1,100));
                $manager->persist($vide1);
                $hodvik->addVideo($vide1);
            }
            if($i < 3){
                $vide2 = new Video();
                $vide2->setTitle('VID_'.\random_int(1,100));
                $manager->persist($vide2);
                $rosi->addVideo($vide2);
            }
            $vide3 = new Video();
            $vide3->setTitle('VID_'.\random_int(1,100));
            $manager->persist($vide3);
            $bella->addVideo($vide3);
        }
        
        $manager->flush();
    }
}
