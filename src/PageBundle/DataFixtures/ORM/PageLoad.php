<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 10/9/2017
 * Time: 9:46 AM
 */

namespace PageBundle\DataFixtures\ORM;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use PageBundle\Entity\Page;
use TermBundle\DataFixtures\ORM\TermLoad;
use TermBundle\Entity\Term;

class PageLoad extends Fixture {

  public function load(ObjectManager $manager) {
    $termRepo = $manager->getRepository(Term::class);
    for ($i = 1 ; $i <= 3; $i++){
      $page = new Page();
      $page->setTitle('Page '.$i);
      $page->setBody('Body Page'. $i);
      $term = $termRepo->findOneByName('Term '.$i);
      if($term){
        $page->setCategory($term);
      }
      $page->setCreated(new \DateTime());
      $manager->persist($page);
    }
    $manager->flush();
  }

  public function getDependencies() {
    return [
      TermLoad::class
    ];
  }
}