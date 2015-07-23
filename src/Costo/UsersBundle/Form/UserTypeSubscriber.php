<?php
/**
 * Permite modificar la manera en que se crean los campos necesarios en cada momento que se solicita el formulario. 
 * A traves de events puede tener el control de como se crearan los campos basados en el usuario actual,  
 * la request y las clases del repositorio
 * 
 * Based on: How to Dynamically Modify Forms Using Form Events
 *
 * @author Carlos Rafael Cabrera
 */
namespace Costo\UsersBundle\Form;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class UserTypeSubscriber implements EventSubscriberInterface
{
    private $securityContext;
    private $request;
    private $em;
    
    public function __construct(SecurityContext $securityContext, Request $request, EntityManager $em)
    {
        $this->securityContext = $securityContext;
        $this->request = $request;
        $this->em = $em;
        
    }

    /*
     *  Tells the dispatcher that you want to listen on the form.pre_set_data
     *  event and that the preSetData method should be called.
     */
    public static function getSubscribedEvents(){
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }  
    
    public function preSetData(FormEvent $event){
        $entity = $event->getData();
        $form = $event->getForm();
        
         //grab the user, do a quick sanity check that one exists
        $user = $this->securityContext->getToken()->getUser();
        if (!$user) 
        {
            throw new \LogicException('Usuario no autenticado!');
        }

        //si el objeto esta siendo creado por el usuario
        if (!$entity || null === $entity->getId())
        {
            $form->add('firstName', null, array('label' => 'Nombre'));
            $form->add('fullName', null, array('label' => 'Nombre y apellidos'));
            $form->add('username', null, array('label' => 'Nombre de usuario'));
            $form->add('email', null, array('label' => 'Correo electronico'));
            $form->add('password', 'repeated', array('first_name' => 'clave', 'second_name' => 'repetir_clave', 'type' => 'password' ));
            $form->add('myRoles', null, array('property' => 'name', 'label' => 'Rol'));
            $form->add('area', null, array('property'=>'nombre','required'=>true));
        }
        //si el objeto esta siendo modificado
        else
        {
            $form->add('firstName', null, array('label' => 'Nombre'));
            $form->add('fullName', null, array('label' => 'Nombre y apellidos'));
            $form->add('username', null, array('label' => 'Nombre de usuario'));
            $form->add('email', null, array('label' => 'Correo electronico'));
            $form->add('myRoles', null, array('property' => 'name', 'label' => 'Rol'));
            $form->add('area', null, array('property'=>'nombre','required'=>true)); 
        }
        
        $form->add('submit', 'submit', array('label' => 'Aceptar','attr'=>array('class'=>'btn btn-primary')));
    }

}
