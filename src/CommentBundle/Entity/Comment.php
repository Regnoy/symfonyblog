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
   * @ORM\ManyToMany(targetEntity="\PageBundle\Entity\Page", inversedBy="comments")
   * @ORM\JoinTable(name="pages_comments")
   */
  private $pages;

  /**
   * @ORM\Column(type="datetime")
   */
  private $created;

  public function  __construct(){
    $this->created = new \DateTime();
    $this->pages = new ArrayCollection();
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
    public function addPage(\PageBundle\Entity\Page $page)
    {
        $this->pages[] = $page;

        return $this;
    }

    /**
     * Remove page
     *
     * @param \PageBundle\Entity\Page $page
     */
    public function removePage(\PageBundle\Entity\Page $page)
    {
        $this->pages->removeElement($page);
    }

    /**
     * Get pages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPages()
    {
        return $this->pages;
    }
}
