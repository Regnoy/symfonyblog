<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 2/5/2018
 * Time: 2:58 PM
 */

namespace UserBundle\Security\User;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use UserBundle\Entity\User;

class UserProvider implements UserProviderInterface {

  private $em;

  public function __construct( EntityManager $entity_manager ) {
    $this->em = $entity_manager;
  }

  public function loadUserByUsername($username) {
    $user = $this->em->getRepository('UserBundle:User')->loadUserByUsername($username);
    if($user)
      return $user;

    throw new UsernameNotFoundException(
      sprintf('Username "%s" does not exist.', $username)
    );
  }

  public function refreshUser(UserInterface $user) {
    return $this->loadUserByUsername($user->getUsername());
  }

  public function supportsClass($class) {
    return User::class === $class;
  }
//HWIOauthBundle
//  public function loadUserByOAuthUserResponse(UserResponseInterface $response){
//
//  }
}