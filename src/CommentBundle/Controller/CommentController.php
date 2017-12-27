<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 12/27/2017
 * Time: 9:14 AM
 */

namespace CommentBundle\Controller;


use CommentBundle\Forms\CommentDeleteForm;
use CommentBundle\Forms\CommentForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller {

  public function editAction($id, Request $request){
    $em = $this->getDoctrine()->getManager();
    $repo = $em->getRepository('CommentBundle:Comment');
    $comment = $repo->find($id);
    if(!$comment)
      return $this->redirectToRoute('page_list');

    $form = $this->createForm(CommentForm::class, $comment );
    $form->handleRequest($request);
    if($form->isSubmitted()){
      $em->persist($comment);
      $em->flush();
      return $this->redirectToRoute('comment_edit', [ 'id' => $comment->getId() ]);
    }
    return $this->render('@Comment/edit.html.twig', [
      'form' => $form->createView()
    ]);
  }

  public function removeAction($id, Request $request){
    $em = $this->getDoctrine()->getManager();
    $repo = $em->getRepository('CommentBundle:Comment');
    $comment = $repo->find($id);
    if(!$comment)
      return $this->redirectToRoute('page_list');

    $form = $this->createForm(CommentDeleteForm::class, null, [
      'delete_id' => $comment->getId()
    ] );

    $form->handleRequest($request);
    if($form->isSubmitted()){
      $em->remove($comment);
      $em->flush();
      return $this->redirectToRoute('page_list');
    }
    return $this->render('CommentBundle::delete.html.twig', [
      'form' => $form->createView()
    ]);
  }
}