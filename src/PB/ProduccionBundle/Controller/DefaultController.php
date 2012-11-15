<?php

namespace PB\ProduccionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PBProduccionBundle:Default:index.html.twig');
    }
}
