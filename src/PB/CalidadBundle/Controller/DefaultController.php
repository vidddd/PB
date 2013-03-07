<?php

namespace PB\CalidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PBCalidadBundle:Default:index.html.twig', array('name' => $name));
    }
}
