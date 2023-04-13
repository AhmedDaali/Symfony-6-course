<?php

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController 
{
    private array $messages = ["Hello", "Hi", "Bye!"];

    //Atributo para definir la ruta del path.
    #[Route('/prova/{limit<\d+>?3}',name:'app_index')]

       /**
     * Método que se ejecuta cuando se accede a la ruta "/prova".
     * 
     * @param int $limit,  El número  de mensajes de saludo que se quiere obtener.
     * @return Response Respuesta HTTP que contiene los mensajes de saludo concatenados.
     */
    public function index(int $limit): Response{
        return new Response (implode( ' , ' ,  array_slice($this->messages, 0, $limit)));
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
        return new Response($this->messages[$id]);
    }

}
?>

