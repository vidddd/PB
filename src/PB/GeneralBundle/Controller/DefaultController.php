<?php

namespace PB\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PBGeneralBundle:Default:index.html.twig');
    }
}
