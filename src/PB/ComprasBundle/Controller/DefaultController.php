<?php

namespace PB\ComprasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('PBComprasBundle:Default:index.html.twig');
    }
}
