<?php

namespace App\Repository;

use App\Entity\Category;

class CategoryRepository {

    /**
     * @var Category[]
     */
    private $categories;

    /**
     * Rempli $this->categories
     * avec 2 categories créées en dur en PHP
     * pour simuler une base de donnée
     * avec 2 catégories dans cette base
     */
    public function __construct()
    {
        $category1 = new Category();
        $category1->setId(1);
        $category1->setName('Sport');

        $category2 = new Category();
        $category2->setId(2);
        $category2->setName('Cuisine');

        $category3 = new Category();
        $category3->setId(3);
        $category3->setName('Tech');

        $this->categories[] = $category1;
        $this->categories[] = $category2;
        $this->categories[] = $category3;
    }

    /**
     * @return Category[]
     */
    public function findAll(): array
    {
        return $this->categories;
    }

    /**
     * @param integer $id
     * @return Category|null
     */
    public function find(int $id): ?Category
    {
        foreach($this->categories as $category){
            if($category->getId() === $id){
                return $category;
            }
        }
        return null;
    }
}
?>