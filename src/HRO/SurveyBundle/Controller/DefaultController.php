<?php

namespace HRO\SurveyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('HROSurveyBundle:Default:index.html.twig', array('name' => $name));
    }
}
