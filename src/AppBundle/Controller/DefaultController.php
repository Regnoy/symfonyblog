<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function previewAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('@App/preview.html.twig');
    }
}
