<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="rating", indexes={@ORM\Index(name="IDX_D88926227294869C", columns={"article_id"}), @ORM\Index(name="IDX_D8892622A76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class Rating
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="rating_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="rate", type="integer", nullable=false)
     */
    private $rate;

    /**
     * @var \App\Entity\Article
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Article")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     * })
     */
    private $article;

    /**
     * @var \App\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of rate
     *
     * @return  int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     *
     * @param  int  $rate
     *
     * @return  self
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get the value of article
     *
     * @return  \App\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set the value of article
     *
     * @param  \App\Entity\Article  $article
     *
     * @return  self
     */
    public function setArticle(\App\Entity\Article $article)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get the value of user
     *
     * @return  \App\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param  \App\Entity\User  $user
     *
     * @return  self
     */
    public function setUser(\App\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }
}
