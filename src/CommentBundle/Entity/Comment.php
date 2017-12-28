<?php
/**
 * Created by PhpStorm.
 * User: pavel
 * Date: 10/13/2017
 * Time: 9:12 AM
 */

namespace CommentBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PageBundle\Entity\Page;

/**
 * Class Page
 * @package PageBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment {

  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;
  /**
   * @ORM\Column(type="text")
   */
  private $comment;


  /**
   * @ORM\ManyToOne(targetEntity="\PageBundle\Entity\Page", inversedBy="comments")
   * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
   */
  private $page;

  /**
   * @ORM\Column(type="datetime")
   */
  private $created;

  public function  __construct(){
    $this->created = new \DateTime();
  }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set comment
     *
     * @param string $comment
     *
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Comment
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
    /**
     * Add page
     *
     * @param \PageBundle\Entity\Page $page
     *
     * @return Comment
     */
    public function setPage(\PageBundle\Entity\Page $page)
    {
        $this->page = $page;

        return $this;
    }


    /**
     * Get pages
     *
     * @return Page
     */
    public function getPage()
    {
        return $this->page;
    }
}
