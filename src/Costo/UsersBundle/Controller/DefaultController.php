<?php

namespace Costo\UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Costo\UsersBundle\Entity\User;

class DefaultController extends Controller
{
     /**
     * Lista todos los usuarios, excepto root
     * 
     * @Route("/usuarios/mostrar")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('CostoUsersBundle:User')->findAll();
        
        if (!$users)
        {
            $this->get('session')->getFlashBag()->add('error','No existen usuarios');
            return array();
        }
        
        return array('entities' => $users);
    }
    
    
    /**
     * Muestra el formulario para adicionar un Usuario
     * 
     * @Route("/admin/usuarios/adicionar")
     * @Template()
     */
    public function addAction(Request $request)
    {   
        $user = new User();
        $form = $this->createForm('costo_usersbundle_user',$user);
        $form->handleRequest($request);

        if($form->isValid())
        {
            //encriptando el password
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success','Usuario adicionado');
            return $this->redirect($this->generateUrl('costo_users_default_index'));
        }

        return  array('form'=>$form->createView());
    }
    
    
    /**
     * Muestra el formulario para modificar un Usuario
     * 
     * @Route("/admin/usuarios/modificar/{id}", defaults={"id" = 0})
     * @Template()
     */
    public function updateAction($id, Request $request)
    {         
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('CostoUsersBundle:User')->find($id);
        
        if (!$user) 
        {
            $this->get('session')->getFlashBag()->add('alert','No existe un Usuario con ese id');
            return $this->redirect($this->generateUrl('costo_users_default_index'));
        }
        
        $form = $this->createForm('costo_usersbundle_user',$user);
        $form->remove('password');
        $form->handleRequest($request);
        
        if($form->isValid())
        {
            $em->flush();
            
            $this->get('session')->getFlashBag()->add('success',"Usuario modificado");
            return $this->redirect($this->generateUrl('costo_users_default_index'));
        }
        
        return array('form'=>$form->createView());
    }
    
    
    /**
    * Muestra un mensaje pidiendo la confirmacion necesaria para eliminar un Usuario
    * 
    * @Route("/admin/usuarios/eliminar/{id}", defaults={"id" = 0})
    * @Template()
    */
    public function askdeleteAction($id)
    {              
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('CostoUsersBundle:User')->find($id);
        
        if (!$user)
        {
            $this->get('session')->getFlashBag()->add('alert','No existe un Usuario con ese id');
            return $this->redirect($this->generateUrl('costo_users_default_index'));
        }
        
        $this->get('session')->getFlashBag()->add('warning','Esta accion no se puede deshacer');
        return array('id'=>$id, 'nombre'=>$user->getUsername());
    }
    
    
    /**
     * Elimina un usuario
     * 
     * @Route("/admin/usuarios/eliminar/confirmado/{id}")
     * @Template()
     */
    public function deleteAction($id)
    {         
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('CostoUsersBundle:User')->find($id);
        
        if (!$user)
        {
            $this->get('session')->getFlashBag()->add('alert','No existe un Usuario con ese id');
            return $this->redirect($this->generateUrl('costo_users_default_index'));
        }
        
        $em->remove($user);
        $em->flush();
        
        $this->get('session')->getFlashBag()->add('success','Usuario eliminado');
        return $this->redirect($this->generateUrl('costo_users_default_index'));
    }
    
    
    /**
     * Muestra el formulario de autenticacion
     * 
     * @Route("/usuarios/login")
     * @Template()
    */
    public function loginPageAction(Request $request)
    {
        //chequear si el usuario no esta autenticado
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY'))     
        {
            $session = $request->getSession();
            // get the login error if there is one
            if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
                $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
            } 
            else 
            {
                $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
                $session->remove(SecurityContext::AUTHENTICATION_ERROR);
            }
                    
            return $this->render('CostoUsersBundle:Default:alllogin.html.twig',
                                array(
                                    // last username entered by the user
                                    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                                    'error'=> $error,
                                )
            );
        }
        else
             return new Response("");
    }
    
}
