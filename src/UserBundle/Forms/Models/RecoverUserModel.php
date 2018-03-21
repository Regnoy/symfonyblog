<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 10/30/2017
 * Time: 8:50 AM
 */

namespace UserBundle\Forms\Models;


class RecoverUserModel {

  public $email;

  /**
   * @return mixed
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * @param mixed $email
   */
  public function setEmail($email) {
    $this->email = $email;
  }
}