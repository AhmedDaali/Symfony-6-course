<?php

namespace App\Controller;

use App\Entity\Micropost;
use App\Repository\MicropostRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicropostRepository $posts): Response
    {
        /*$micrPost = new Micropost();
        $micrPost->setTitle('It comes from controller');
        $micrPost->setText('Hola');
        $micrPost->setCreated(new DateTime());*/

        $micrPost = $posts->find(1);
        $micrPost->setTitle('Welcome en general!');
        $posts->add($micrPost, true);

        $micrPost = $posts->find(4);
        $posts->remove($micrPost, true);


        //dd($posts->findAll());
        //dd($posts->find(1));
        //dd($posts->findOneBy(['title'=>'Welcome to US']));
        return $this->render('micro_post/index.html.twig', [
            'controller_name' => 'MicroPostController',
        ]);
    }
}
