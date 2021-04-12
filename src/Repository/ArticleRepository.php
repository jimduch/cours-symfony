<?php
//src/Repository/ArticleRepository.php

namespace App\Repository;

use App\Entity\Article;

class ArticleRepository
{
    /**
     * Simule une base de données d'article
     *
     * @var Article[]
     */
    private $articles;

    public function __construct()
    {
        $categoryRepository = new CategoryRepository();
        for($i = 0; $i < 20; $i++){
            $article = new Article();
            $article->setId($i);
            $article->setTitle('Mon super titre '.$i);
            $article->setContent('Mon super contenu '.$i);
            $article->setImportant('article important'.$i);
           $article->setPublicationDate(new \DateTime (2021-02-01));

            
            if($i=== 1 || $i=== 3 || $i=== 7|| $i=== 15)
              $article->setImportant(true);
            else  $article->setImportant(false);


            if($i < 7){
                $category = $categoryRepository->find(1);
                $article->setCategory($category);
            } else {
                $category = $categoryRepository->find(2);
                $article->setCategory($category);
            }

            $this->articles[] = $article;
        }

    }

    /**
     * Retrouve tous mes articles
     * de ma fausse base de données
     *
     * @return Article[]
     */
    public function findAll() : array
    {
        return $this->articles;
    }

    /**
     * Retrouve un article via son id
     * dans ma fausse bdd
     *
     * @param integer $id
     * @return Article|null
     */
    public function find(int $id): ?Article
    {
        foreach($this->articles as $article){
            if($article->getId() === $id){
               return $article; 
            }
        }
        return null;
    }
}
