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
     * @Route("/site", name="site")
     */
    public function indexAction()
    {
        return $this->render('FrontPageBundle:FrontPage:index.html.twig');
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function blogAction()
    {
        return $this->render('FrontPageBundle:FrontPage:blog.html.twig');
    }

    /**
     * @Route("/competences", name="competences")
     */
    public function competencesAction()
    {
        return $this->render('FrontPageBundle:FrontPage:competences.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render('FrontPageBundle:FrontPage:contact.html.twig');
    }

    /**
     * @Route("/services", name="services")
     */
    public function servicesAction()
    {
        return $this->render('FrontPageBundle:FrontPage:services.html.twig');
    }

    /**
     * @Route("/societe", name="societe")
     */
    public function societeAction()
    {
        return $this->render('FrontPageBundle:FrontPage:societe.html.twig');
    }

}
