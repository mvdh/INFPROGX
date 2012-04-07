<?php

namespace HRO\SurveyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{

    public function indexAction()
    {
        $text = 'Welkom op deze enquete website. Morbi rhoncus dapibus hendrerit. Vestibulum nec lacus non dui aliquam mollis. Curabitur magna ipsum, consectetur in sollicitudin at, aliquet et justo. Nam vel mi sed lorem iaculis commodo sit amet vitae lacus. In volutpat feugiat nunc, eu ornare mauris auctor id. Sed ac nisl metus. In vulputate mattis nisl, sed mattis erat euismod ut. Sed eget tempus leo.';
        return $this->render('HROSurveyBundle:Default:index.html.twig', array('text' => $text));
    }
}
