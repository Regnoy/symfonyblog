<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlockController extends Controller {

  public function logoAction(){
    return $this->render('@App/Block/logo.html.twig');
  }
  public function mainMenuAction(){
    return $this->render('@App/Block/main-menu.html.twig');
  }
  public function mainMenuFooterAction(){
    return $this->render('@App/Block/main-menu-footer.html.twig');
  }
}