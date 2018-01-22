<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 1/22/2018
 * Time: 9:32 AM
 */

namespace PageBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository {


  public function findPages( $page = 1, $limit = 10 ){
    $qry = $this->createQueryBuilder('p');
    $qry->setMaxResults($limit);
    $qry->setFirstResult( ( $limit * $page ) - $limit );//10*2=20 - 10 = 0
    return $qry->getQuery()->getResult();
  }

  public function countPage(){
    $qry = $this->createQueryBuilder('p')->select('count(p.id)');
    $result = $qry->getQuery()->getOneOrNullResult();//[ 1 => 3]
    return $result ? array_shift($result) : 0;
  }

}