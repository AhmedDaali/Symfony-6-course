<?php

namespace App\DataFixtures;

use App\Entity\Micropost;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $micoPost1 = new Micropost();
         $micoPost1->setTitle('Welcome to Poland');
         $micoPost1->setText('Welcome to Poland2');
         $micoPost1->setCreated(new DateTime());
         $manager->persist($micoPost1);

         $micoPost2 = new Micropost();
         $micoPost2->setTitle('Welcome to US');
         $micoPost2->setText('Welcome to US2');
         $micoPost2->setCreated(new DateTime());
         $manager->persist($micoPost2);

         $miroPost3 = new Micropost();
         $miroPost3->setTitle('Welcome to Germany');
         $miroPost3->setText('Welcome to Germany2');
         $miroPost3->setCreated(new DateTime());
         $manager->persist($miroPost3);

        $manager->flush();
    }
}
