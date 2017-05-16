<?php

namespace LBM\FrontPageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function siteAction()
    {
        return $this->render('FrontPageBundle:Default:index.html.twig');
    }

    /**
     * @Route("/site")
     */
    public function indexAction()
    {
        return $this->render('FrontPageBundle:FrontPage:index.html.twig');
    }

}
