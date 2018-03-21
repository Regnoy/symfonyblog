<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 2/2/2017
 * Time: 9:06 AM
 */

namespace UserBundle\DataFixtures\ORM;


use CoreBundle\Core\Core;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\Role;
use UserBundle\Entity\User;
use UserBundle\Entity\UserAccount;

class UserLoad implements FixtureInterface {
  
  public function load(ObjectManager $manager) {
    
    $roleRepo = $manager->getRepository(Role::class);
    $role = $roleRepo->findOneByRole('USER_ROLE');
    if(!$role)
      return;
    
    $encoder = Core::service('security.password_encoder');
    $user = new User();
    $password = $encoder->encodePassword($user, '123456');
    $user->setPassword($password);
    $user->addRole($role);
    $user->setEmail('info@utilvideo.com');
    
    $userAccount = new UserAccount();
    $userAccount->setFirstName('John')->setLastName('Doe');
    $userAccount->setBirthday( new \DateTime() );
    $userAccount->setGender('m');
    
    $em = Core::em();
    $em->beginTransaction();
    try{
      $em->persist($user);
      $em->flush();
      $userAccount->setUser($user);
      $em->persist($userAccount);
      $em->flush();
      $em->commit();
    } catch( \Exception $e ){
      $em->rollback();
    }
  }
  public function getOrder(){
    return 2;
  }
}