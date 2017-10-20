<?php


namespace PageBundle\Controller;


use PageBundle\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller {

  public function listAction(){
    $pageRepo = $this->getDoctrine()->getRepository('PageBundle:Page');
    $pages = $pageRepo->findAll();
    return $this->render('PageBundle:Page:list.html.twig',[
      'pages' => $pages
    ]);
  }

  public function viewAction($id){
    $pageRepo = $this->getDoctrine()->getRepository('PageBundle:Page');
    /** @var Page $page */
    $page = $pageRepo->find($id);
    if(!$page){
      throw $this->createNotFoundException('The page does not exist');
    }
    return $this->render('PageBundle:Page:view.html.twig',[
      'page' => $page
    ]);
  }

}