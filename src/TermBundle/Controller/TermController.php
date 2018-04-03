<?php

namespace TermBundle\Controller;

use PageBundle\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TermBundle\Entity\Term;
use TermBundle\Forms\TermDeleteForm;
use TermBundle\Forms\TermForm;

class TermController extends Controller {

  public function listAction(){
    $terms = $this->getDoctrine()->getRepository('TermBundle:Term')->findAll();


    return $this->render('@Term/Page/list.html.twig', [
      'terms' => $terms
    ]);
  }

  public function addAction(Request $request){

    $term = new Term();
    $form = $this->createForm(TermForm::class, $term );
    $form->handleRequest($request);
    if($form->isSubmitted()){
      $em = $this->getDoctrine()->getManager();
      $em->persist($term);
      $em->flush();
      return $this->redirectToRoute('term_list');
    }
    return $this->render('@Term/Page/add.html.twig', [
      'form' => $form->createView()
    ]);

  }
  public function viewAction($id){
    $repo = $this->getDoctrine()->getRepository('TermBundle:Term');
    /** @var Term $term */
    $term = $repo->find($id);
    if(!$term){
      throw $this->createNotFoundException('The term does not exist');
    }
    $pageRepo = $this->getDoctrine()->getRepository(Page::class);
    $pages = $pageRepo->findByTerms($term);
    return $this->render('TermBundle:Page:view.html.twig',[
      'term' => $term,
      'pages' => $pages
    ]);
  }
  public function editAction($id, Request $request){
    $em = $this->getDoctrine()->getManager();
    $repo = $em->getRepository('TermBundle:Term');
    $term = $repo->find($id);
    if(!$term)
      return $this->redirectToRoute('term_list');

    $form = $this->createForm(TermForm::class, $term );
    $form->handleRequest($request);
    if($form->isSubmitted()){
      $em->persist($term);
      $em->flush();
      return $this->redirectToRoute('term_view', [ 'id' => $term->getId() ]);
    }
    return $this->render('@Term/Page/edit.html.twig', [
      'form' => $form->createView()
    ]);
  }

  public function deleteAction($id, Request $request){
    $em = $this->getDoctrine()->getManager();
    $repo = $em->getRepository('TermBundle:Term');
    $term = $repo->find($id);
    if(!$term)
      return $this->redirectToRoute('term_list');

    $form = $this->createForm(TermDeleteForm::class, null, [
      'delete_id' => $term->getId()
    ] );

    $form->handleRequest($request);
    if($form->isSubmitted()){
      $em->remove($term);
      $em->flush();

      return $this->redirectToRoute('term_list');
    }
    return $this->render('@Term/Page/delete.html.twig', [
      'form' => $form->createView()
    ]);
  }

}