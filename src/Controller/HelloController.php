<?php

namespace App\Controller;

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
    #[Route('/prova/{limit<\d+>?3}',name:'app_index')]

       /**
     * Método que se ejecuta cuando se accede a la ruta "/prova".
     * 
     * @param int $limit,  El número  de mensajes de saludo que se quiere obtener.
     * @return Response Respuesta HTTP que contiene los mensajes de saludo concatenados.
     */
    public function index(int $limit): Response{
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
            'limit'=> $limit
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

