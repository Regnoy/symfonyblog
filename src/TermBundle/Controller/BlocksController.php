<?php

namespace TermBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlocksController extends Controller {

  public function categoryAction(){
    $terms = $this->getDoctrine()->getRepository('TermBundle:Term')->findAll();
    return $this->render('@Term/Block/category-list.html.twig', [
      'terms' => $terms
    ]);
  }
}