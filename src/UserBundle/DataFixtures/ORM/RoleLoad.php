<?php


namespace UserBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\Role;

class RoleLoad implements FixtureInterface {
  
  public function load(ObjectManager $manager) {
    $roleRepo = $manager->getRepository(Role::class);
    $role = $roleRepo->findByRole('ROLE_USER');
    if(!$role){
      $role = new Role();
      $role->setName("ROLE USER");
      $role->setRole("ROLE_USER");
      $manager->persist($role);
      $manager->flush();
    }
  }
  public function getOrder(){
    return 1;
  }
}