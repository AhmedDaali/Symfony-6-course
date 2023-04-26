<?php

namespace App\Controller;

use DateTime;
use App\Entity\Comment;
use App\Entity\Micropost;
use App\Form\CommentType;
use App\Form\MicroPostType;
use App\Repository\CommentRepository;
use App\Repository\MicropostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/*Este es un controlador de Symfony para la entidad Micropost. El controlador contiene una sola acción "index", que está asociada a la ruta "/micro-post" y el nombre de la ruta es "app_micro_post". Esta acción utiliza la clase MicropostRepository para realizar operaciones CRUD en la tabla de base de datos correspondiente a la entidad Micropost.

El controlador extiende la clase AbstractController de Symfony, lo que le permite acceder a los servicios de Symfony, como el servicio de renderización de plantillas.

La acción index toma un parámetro de tipo MicropostRepository llamado $posts. Este parámetro se inyecta automáticamente por el sistema de inyección de dependencias de Symfony.

Dentro de la acción index, se crea una nueva instancia de la entidad Micropost con un título, texto y fecha de creación específicos. Luego, se utiliza el objeto $posts para realizar algunas operaciones CRUD en la tabla Micropost.

Primero, se obtiene una instancia de Micropost de la tabla con el ID 1 utilizando el método find(). Luego, se actualiza el título de esta instancia y se utiliza el método add() de $posts para guardar los cambios en la tabla.

Después, se obtiene otra instancia de Micropost con el ID 4 utilizando el método find(). Luego, se utiliza el método remove() de $posts para eliminar esta instancia de la tabla.

Finalmente, se utilizan varios métodos de $posts para obtener instancias de Micropost de la tabla y se utiliza la función dd() (die and dump) para imprimir los resultados en la página y detener la ejecución del código.

El método render() se utiliza para renderizar la plantilla "micro_post/index.html.twig" y pasarle un arreglo que contiene el nombre del controlador.*/
class MicroPostController extends AbstractController
{
    #[Route('/micro-post', name: 'app_micro_post')]
    public function index(MicropostRepository $posts): Response
    {
        /*$micrPost = new Micropost();
        $micrPost->setTitle('It comes from controller');
        $micrPost->setText('Hola');
        $micrPost->setCreated(new DateTime());

        $micrPost = $posts->find(1);
        $micrPost->setTitle('Welcome en general!');
        $posts->add($micrPost, true);

        $micrPost = $posts->find(4);
        $posts->remove($micrPost, true);*/


        //dd($posts->findAll());
       // dd($posts->find(1));
        //dd($posts->findOneBy(['title'=>'Welcome to US']));
        return $this->render('micro_post/index.html.twig', [
            'posts' => $posts->findAllWithComments(),
        ]);
    }
    //Buscar un post por ID sin sensio/framework
    /*#[Route('/micro-post/{id}', name: 'app_micro_post')]
    public function showOne($id, MicropostRepository $posts): Response
    {
        dd($posts->find($id));
    }*/

    //Buscar un post por ID con sensio/framework
    #[Route('/micro-post/{post}', name: 'app_micro_post_show')]
    public function showOne(Micropost $post): Response
    {
        return $this->render('micro_post/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route(
        '/micro-post/add',
        name: 'app_micro_post_add',
        priority: 2
    )]
    public function add(
        Request $request,
        MicropostRepository $posts
    ): Response {
        $form = $this->createForm(
            MicroPostType::class,
            new Micropost()
        );
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $post = $form->getData();
            $post->setCreated(new DateTime());
            $post->setAuthor($this->getUser());
            $posts->add($post, true);

            //Add a flash
            $this->addFlash('success', 'Your micro post have been added');
            //Redirect
            return $this->redirectToRoute('app_micro_post');
        }

        return $this->renderForm(
            'micro_post/add.html.twig',
             [
            'form' => $form,
             ]
        );
    }
    #[Route('/micro-post/{post}/edit', name: 'app_micro_post_edit')]
    public function edit(Micropost $post, Request $request, MicropostRepository $posts): Response
    {
        $form = $this->createForm(MicroPostType::class, $post);
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $posts->add($post, true);
            // Add a flash
            $this->addFlash('success', 'Your micro post have been updated.');
            // Redirect
            return $this->redirectToRoute('app_micro_post');
        }

        return $this->renderForm(
            'micro_post/edit.html.twig',
             [
                'form' => $form,
                'post' => $post
             ]
        );
    }
    #[Route('/micro-post/{post}/comment', name: 'app_micro_post_comment')]
    public function addComment(Micropost $post, Request $request, CommentRepository $comments): Response
    {
        $form = $this->createForm(CommentType::class, new Comment());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setPost($post);
            $comment->setAuthor($this->getUser());
            $comments->add($comment, true);

            // Add a flash
            $this->addFlash('success', 'Your comment have been updated.');

            return $this->redirectToRoute(
                'app_micro_post_show',
                ['post' => $post->getId()]
            );
            // Redirect
        }

        return $this->renderForm(
            'micro_post/comment.html.twig',
            [
                'form' => $form,
                'post' => $post
            ]
        );
    }
}
