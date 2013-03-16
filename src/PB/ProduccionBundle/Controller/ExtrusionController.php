<?php

namespace PB\ProduccionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ExtrusionController extends Controller
{
    public function indexAction()
    {
        return $this->render('PBProduccionBundle:Extrusion:index.html.twig');
    }
    public function maquinariaAction()
    {
    	return $this->render('PBProduccionBundle:Default:maquinaria.html.twig');
    }
}
