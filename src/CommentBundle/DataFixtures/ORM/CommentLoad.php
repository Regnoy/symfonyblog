<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 10/13/2017
 * Time: 9:18 AM
 */

namespace CommentBundle\DataFixtures\ORM;


use CommentBundle\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use PageBundle\DataFixtures\ORM\PageLoad;

class CommentLoad extends Fixture {

  public function load(ObjectManager $manager) {
    $pageRepo = $manager->getRepository('PageBundle:Page');
    $pages = $pageRepo->findAll();
    foreach ($pages as $page){
      for( $i = 1; $i <=15; $i++){
        $comment = new Comment();
        $comment->setComment('Comment '.$i. ' > '.$page->getTitle());
        $page->addComment($comment);
        $comment->setPage($page);
      }
      $manager->persist($page);
    }
    $manager->flush();
  }
  public function getDependencies() {
    return [
      PageLoad::class
    ];
  }
}