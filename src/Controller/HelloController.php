<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Controller\MicroPostController;
use App\Repository\CommentRepository;
use App\Entity\Comment;
use App\Entity\Micropost;
use App\Repository\MicropostRepository;
use App\Repository\UserProfileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    //private array $messages = ["Hello", "Hi", "Bye!"];

    
    private array $messages = [
        ['message' => 'Hello', 'created' => '2022/06/12'],
        ['message' => 'Hi', 'created' => '2022/04/12'],
        ['message' => 'Bye!', 'created' => '2021/05/12']
    ];
    //Atributo para definir la ruta del path.
    #[Route('/', name: 'app_index')]

       /**
     * Método que se ejecuta cuando se accede a la ruta "/prova".
     * 
     * @param int $limit,  El número  de mensajes de saludo que se quiere obtener.
     * @return Response Respuesta HTTP que contiene los mensajes de saludo concatenados.
     */
    public function index(MicropostRepository $posts, CommentRepository $comments): Response
    {
         //$post = new MicroPost();
         //$post->setTitle('Hello');
         //$post->setText('Hello');
         //$post->setCreated(new DateTime());
         //$post = $posts->find(11);
         //$comment = new Comment();
         //$comment->setText('Hello');

        // $post->addComment($comment);

         
         //$comment = $post->getComments()[0];
         //$post->removeComment($comment);
         //$comment->setPost($post);
         //$comments->add($comment, true);
         //$posts->add($post, true);
        // dd($post);


        // $user = new User();
        // $user->setEmail('email@email.com');
        // $user->setPassword('12345678');

        // $profile = new UserProfile();
        // $profile->setUser($user);
        // $profiles->add($profile, true);

        // $profile = $profiles->find(1);
        // $profiles->remove($profile, true);

        //return new Response ();
        return $this->render(
            'hello/index.html.twig',
        [
            /*Implode se usa para convertir un array en un String.
            Lo separamos por una coma por ejemplo. */   
            /*'message'=>implode( 
                ' , ' ,  array_slice($this->messages, 0, $limit))*/


            /*Sino usamos implode hay que poner un for en el template 
            par poder renderizar el array.*/
            //'messages'=> array_slice($this->messages, 0, $limit)


            /*Aquí no hacemos la lógica, solo le pasamos al template los
            parámetros. En el template pondremos la lógiga necesaria para 
            renderizar el array*/


            'messages'=> $this->messages,
            'limit'=> 3
        ]);
    }

    //Atributo para definir la ruta del path.
    #[Route('/messages/{id<\d+>}',name:'app_show_one')]
     /**
     * Método que se ejecuta cuando se accede a una ruta que incluye un parámetro llamado "id".
     * El valor del parámetro "id" se utiliza para obtener un mensaje de saludo específico del array "messages".
     * 
     * @param int $id El índice del mensaje de saludo que se quiere obtener.
     * 
     * @return Response Respuesta HTTP que contiene el mensaje de saludo correspondiente al índice especificado.
     */
    public function showOne (int $id): Response 
    {
        return $this->render(
            'hello/show_one.html.twig', 
            [
                'message'=> $this->messages[$id]
                ]
        );
        //return new Response($this->messages[$id] );
    }

}
?>

