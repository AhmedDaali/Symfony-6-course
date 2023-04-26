<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use App\Entity\MicroPost;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

//Este es un archivo de Fixtures que utiliza la clase Micropost para cargar algunos datos de prueba en la base de datos.
class AppFixtures extends Fixture
{

    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    ) {
    }
    //Se define el método load que recibe un objeto ObjectManager como argumento.
    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('test@test.com');
        $user1->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user1,
                '12345678'
            )
        );
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('john@test.com');
        $user2->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user2,
                '12345678'
            )
        );
        $manager->persist($user2);

        //Se crea una instancia de la clase Micropost y se asigna a la variable $microPost1.
         $microPost1 = new Micropost();
         $microPost1->setTitle('Welcome to Poland');
         $microPost1->setText('Welcome to Poland2');
         $microPost1->setCreated(new DateTime());
         $microPost1->setAuthor($user1);
         //Se agrega el objeto $micoPost1 al gestor de objetos para que sea persistido en la base de datos.
         $manager->persist($microPost1);

         $microPost2 = new Micropost();
         $microPost2->setTitle('Welcome to US');
         $microPost2->setText('Welcome to US2');
         $microPost2->setCreated(new DateTime());
         $microPost2->setAuthor($user2);
         $manager->persist($microPost2);

         $microPost3 = new Micropost();
         $microPost3->setTitle('Welcome to Germany');
         $microPost3->setText('Welcome to Germany2');
         $microPost3->setCreated(new DateTime());
         $microPost3->setAuthor($user1);
         $manager->persist($microPost3);

         //Se ejecuta el método flush del gestor de objetos para persistir los objetos creados en la base de datos.
        $manager->flush();
    }
}
