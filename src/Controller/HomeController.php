<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends AbstractController{
/**
     * @Route("/", name="home")
     * @Template
     */
    public function home(Request $request):array {
        $articleRepository = new ArticleRepository();
        $articles = $articleRepository->findAll();
        $name = $request->query->get('name');
        $articletable=[];
        if(empty($name)){
            $articletable = $articles;

        }
        else{
            foreach($articles as $article){
                $val = strpos($article->getTitle(),$name );
                if($val){
                $articletable[] = $article;
                }
            }
        }
        
        return ['articles' =>$articletable];
    }
}