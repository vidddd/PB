<?php

namespace PB\InicioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('PBInicioBundle:Default:index.html.twig');
    }
}
