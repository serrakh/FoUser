<?php

namespace Rdv\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RdvFrontEndBundle:Default:index.html.twig');
    }
}
