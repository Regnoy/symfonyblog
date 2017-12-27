<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 12/27/2017
 * Time: 9:01 AM
 */

namespace CommentBundle\Forms;


use CommentBundle\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentForm extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('comment');
    $builder->add('submit', SubmitType::class, [
      'label' => 'Add comment'
    ]);
  }

  public function configureOptions(OptionsResolver $resolver) {
    $resolver->setDefaults([
      'data_class' => Comment::class
    ]);
  }
}