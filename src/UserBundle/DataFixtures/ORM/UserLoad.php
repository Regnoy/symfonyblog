<?php

namespace UserBundle\DataFixtures\ORM;


use App\DataFixtures\ORM\RoleLoad;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\Role;
use UserBundle\Entity\User;
use UserBundle\Entity\UserAccount;

class UserLoad extends Fixture  {

  public function load(ObjectManager $manager) {

    $roleRepo = $manager->getRepository(Role::class);
    $role = $roleRepo->findOneByRole('ROLE_USER');
    if(!$role)
      return;

    $encoder = $this->container->get('security.password_encoder');
    $user = new User();
    $password = $encoder->encodePassword($user, '123456');
    $user->setPassword($password);
    $user->addRole($role);
    $user->setEmail('info@utilvideo.com');

    $userAccount = new UserAccount();
    $userAccount->setFirstName('John')->setLastName('Doe');
    $userAccount->setBirthday( new \DateTime() );
    $manager->persist($user);
    $manager->flush();
    $userAccount->setUser($user);
    $manager->persist($userAccount);
    $manager->flush();


  }

  public function getDependencies()
  {
    return [
      RoleLoad::class
    ];
  }

}