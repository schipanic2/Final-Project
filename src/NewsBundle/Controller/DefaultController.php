<?php

namespace NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/home")
     */
    public function indexAction()
    {
        return $this->render('NewsBundle:Default:index.html.twig');
    }
    
    /**
     * @Route("/about")
     */
    public function aboutAction()
    {
        return $this->render('NewsBundle:Default:about.html.twig');
    }
    

}
