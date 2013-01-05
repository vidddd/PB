<?php

namespace PB\ContabilidadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PBContabilidadBundle:Default:index.html.twig', array('name' => $name));
    }
}
