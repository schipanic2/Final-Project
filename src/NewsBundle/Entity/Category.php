<?php

namespace NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NewsBundle\Entity\Article;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="NewsBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;
    
    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="category", cascade="remove")
     */
    
    protected $articles;


    public function __construct() {
        $this->articles = new ArrayCollection();
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
     * @return Category
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
     * Set articles
     *
     * @param object $articles
     * @return Category
     */
    public function setArticle($articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Get articles
     *
     * @return object 
     */
    public function getArticles()
    {
        return $this->articles;
    }
    
    public function __toString(){
        return $this->title;
    }
    

}
