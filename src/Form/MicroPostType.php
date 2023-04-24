<?php

namespace App\Form;

use App\Entity\MicroPost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//Define la clase MicroPostType como una extensión de la clase AbstractType de Symfony. Esta clase es la base para todos los tipos de formularios de Symfony.
class MicroPostType extends AbstractType
{
    /*Este método define cómo se construirá el formulario. 
    En este caso, se agregan dos campos al formulario: title y text.
    Los campos se agregan al objeto $builder que se pasa como argumento al método.
    */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('text');
    }

    /*Este método configura las opciones del formulario.
     En este caso, se establece la opción data_class en MicroPost::class, 
     que indica la clase de entidad a la que se vinculará el formulario.*/
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MicroPost::class,
        ]);
    }
}