<?php

namespace Costo\MaterialesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MaterialesBundle:Default:index.html.twig', array('name' => $name));
    }
}
