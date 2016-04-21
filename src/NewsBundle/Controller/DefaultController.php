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
        $articles = $this->getDoctrine()->getRepository('NewsBundle:Article')->findBy(array(), array('id' => 'DESC'), 3);
        return $this->render('NewsBundle:Default:index.html.twig', array("articles" => $articles));
    }
    
    /**
     * @Route("/about")
     */
    public function aboutAction()
    {
        return $this->render('NewsBundle:Default:about.html.twig');
    }
    

}
