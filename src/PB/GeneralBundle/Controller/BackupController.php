<?php

namespace PB\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BackupController extends Controller
{
    public function indexAction()
    {
        return $this->render('PBGeneralBundle:Backup:index.html.twig');
    }
}
