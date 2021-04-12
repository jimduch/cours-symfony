<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController2 extends AbstractController
{
    /**
     * @Route("/articles2")
     * @return Response
     */
    public function getArticles(): Response
    {
        $articleRepository = new ArticleRepository();
        $articles = $articleRepository->findAll();
        $content = '<ul>';
        foreach ($articles as $article) {
            $content .= '<li>' . $article->getTitle() . '</li>';
        }
        $content .= '</ul>';
        return new Response($content);
    }

    /**
     * @Route("/articles2/{id}")
     * @param $id
     * @return Response
     */
    public function getArticle($id): Response
    {
        $articleRepository = new ArticleRepository();
        $article = $articleRepository->find($id);
        if (!$article) {
            throw $this->createNotFoundException('Cannot found article with id ' . $id);
        }
        $content = '<h1>' . $article->getTitle() . '</h1>';
        $content .= '<img src="' . $article->getImgPath() . '"/>';
        $content .= '<div>' . $article->getContent() . '</div>';
        return new Response($content);
    }
}
