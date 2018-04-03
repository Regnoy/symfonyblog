<?php

namespace PageBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use UserBundle\Entity\User;

/**
 * Class Page
 * @package PageBundle\Entity
 * @ORM\Entity(repositoryClass="PageBundle\Repository\PageRepository")
 * @ORM\Table(name="page")
 */
class Page {

  /**
   * @ORM\Column(type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=255)
   */
  private $title;

  /**
   * @ORM\Column(type="text")
   */
  private $body;

  /**
   * @ORM\ManyToOne(targetEntity="\TermBundle\Entity\Term", inversedBy="pages")
   * @ORM\JoinColumn(name="term_id", referencedColumnName="id")
   */
  private $category;

  /**
   * @ORM\Column(type="datetime")
   */
  private $created;

  /**
   * @ORM\OneToMany(targetEntity="\CommentBundle\Entity\Comment", mappedBy="page", cascade={"persist", "remove"})
   * @ORM\OrderBy({"id" = "DESC"})
   */
  private $comments;

  /**
   * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\User")
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
   */
  private $user;

  public function __construct() {
    $this->created = new \DateTime();
    $this->comments = new ArrayCollection();
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
   * Set title
   *
   * @param string $title
   *
   * @return Page
   */
  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  /**
   * Get title
   *
   * @return string
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Set body
   *
   * @param string $body
   *
   * @return Page
   */
  public function setBody($body)
  {
    $this->body = $body;

    return $this;
  }

  /**
   * Get body
   *
   * @return string
   */
  public function getBody()
  {
    return $this->body;
  }

  /**
   * Set created
   *
   * @param \DateTime $created
   *
   * @return Page
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
   * Set category
   *
   * @param \TermBundle\Entity\Term $category
   *
   * @return Page
   */
  public function setCategory(\TermBundle\Entity\Term $category = null)
  {
    $this->category = $category;

    return $this;
  }

  /**
   * Get category
   *
   * @return \TermBundle\Entity\Term
   */
  public function getCategory()
  {
    return $this->category;
  }

  /**
   * Add comment
   *
   * @param \CommentBundle\Entity\Comment $comment
   *
   * @return Page
   */
  public function addComment(\CommentBundle\Entity\Comment $comment)
  {
    $this->comments[] = $comment;
    return $this;
  }

  /**
   * Remove comment
   *
   * @param \CommentBundle\Entity\Comment $comment
   */
  public function removeComment(\CommentBundle\Entity\Comment $comment)
  {
    $this->comments->removeElement($comment);
  }

  /**
   * Get comments
   *
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getComments()
  {
    return $this->comments;
  }
  public function setId(){
    //
  }

  /**
   * @return mixed
   */
  public function getUser()
  {
    return $this->user;
  }


  public function setUser(User $user)
  {
    $this->user = $user;
  }

}
