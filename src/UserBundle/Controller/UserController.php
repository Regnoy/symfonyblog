<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 11/10/2017
 * Time: 8:53 AM
 */

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Forms\ChangePasswordForm;
use UserBundle\Forms\Models\ChangePasswordModel;

class UserController extends Controller {


  public function recoverPasswordAction( Request $request ){
    /** @var User $user */
    $user = $this->getUser();
    $userAccount = $user->getAccount();
    if(!$userAccount->getTokenRecover())
      return $this->redirectToRoute('user');

    $changePasswordModel = new ChangePasswordModel();
    $formChangePassword = $this->createForm(ChangePasswordForm::class, $changePasswordModel);
    $formChangePassword->handleRequest($request);
    if($formChangePassword->isSubmitted() && $formChangePassword->isValid()){
      $encoder = $this->get('security.password_encoder');
      $password = $encoder->encodePassword($user, $changePasswordModel->password);
      $user->setPassword($password);
      $userAccount->setTokenRecover(null);
      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();
      return $this->redirectToRoute('user');
    }
    return $this->render('@User/security/recover.html.twig',[
      'recover_form' => $formChangePassword->createView()
    ]);
  }
}