<?php
//src/Entity/Article.php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */

class Article {
    
 /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var bool
     */
    private $important;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\Length(max="255", maxMessage="Le nombre de caractère est limité à 255")
     * @Assert\NotBlank(message="Le titre ne doit pas être vide")
     */
    private $title;

        
    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $content;

        
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $imgPath;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * @ORM\JoinColumn(nullable=true)
     */
    private $category;


     /**
     * @var DateTime
     *  @ORM\Column(type="datetime")
     */
    private $publicationDate;
    /**
     */
    public function __construct()
    {
        //Pour ceux qui la propriété $important
        $this->important = true;

        
        //Pour ceux qui la propriété $publicationDate
        
        $this->publicationDate = new \DateTime();
        $this->imgPath = "\aaa";

    }


    /**
     * Get the value of imgPath
     *
     * @return  string
     */ 
    public function getImgPath()
    {
        return $this->imgPath;
    }

    /**
     * Set the value of imgPath
     *
     * @param  string  $imgPath
     *
     * @return  self
     */ 
    public function setImgPath(string $imgPath)
    {
        $this->imgPath = $imgPath;

        return $this;
    }

    /**
     * Get the value of content
     *
     * @return  string
     */ 
    public function getContent() :string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param  string  $content
     *
     * @return  self
     */ 
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title = null)
    {
        $this->title = $title;

        return $this;
    }

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
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of category
     *
     * @return  Category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @param  Category  $category
     *
     * @return  self
     */ 
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of important
     *
     * @return  bool
     */ 
    public function getImportant()
    {
        return $this->important;
    }

    /**
     * Set the value of important
     *
     * @param  bool  $important
     *
     * @return  self
     */ 
    public function setImportant(bool $important)
    {
        $this->important = $important;

        return $this;
    }

   

    

    /**
     * Get the value of publicationDate
     *
     * @return  DateTime
     */ 
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Set the value of publicationDate
     *
     * @param  DateTime  $publicationDate
     *
     * @return  self
     */ 
    public function setPublicationDate(\DateTime $publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }
}