<?php

namespace FitcheckerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FitcheckerBundle:Default:index.html.twig');
    }
}
