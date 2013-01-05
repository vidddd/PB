<?php

namespace PB\AlmacenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PBAlmacenBundle:Default:index.html.twig');
    }
}
