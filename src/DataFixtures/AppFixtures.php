<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\User;
use App\Entity\MicroPost;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

//Este es un archivo de Fixtures que utiliza la clase Micropost para cargar algunos datos de prueba en la base de datos.
class AppFixtures extends Fixture
{
    //Se define el método load que recibe un objeto ObjectManager como argumento.
    public function load(ObjectManager $manager): void
    {
        //Se crea una instancia de la clase Micropost y se asigna a la variable $micoPost1.
         $micoPost1 = new Micropost();
         $micoPost1->setTitle('Welcome to Poland');
         $micoPost1->setText('Welcome to Poland2');
         $micoPost1->setCreated(new DateTime());
         //Se agrega el objeto $micoPost1 al gestor de objetos para que sea persistido en la base de datos.
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

         //Se ejecuta el método flush del gestor de objetos para persistir los objetos creados en la base de datos.
        $manager->flush();
    }
}
