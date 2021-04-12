<?php
//src/Controller/ArticleController.php
namespace App\Controller;




use App\Entity\Article;
use App\Form\Type\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ArticleController extends AbstractController
{
/**
 * @var ManagerRegistry
 */
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @Route("/articles", name="articles")
     * @Template
     * @return Response
     */
    //-------Modifier le contrôleur "liste d'article--------
    public function getArticles(Request $request): Response
    {

        
        $articleRepository = $this->doctrine->getRepository(Article::class);

        $articles = $articleRepository->findAll();
        $name = $request->query->get('name');
        $articletable = [];
        if (empty($name)) {
            $articletable = $articles;

        } else {
            foreach ($articles as $article) {
                $val = strpos($article->getTitle(), $name);
                if ($val) {
                    $articletable[] = $article;
                }
            }
        }
        $response= new Response (json_encode($articletable,JSON_FORCE_OBJECT));
        $response->headers->set('Content-Type','application/json');
        $response->headers->set('Access-Control-Allow-Origin','*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,PATCH');

        return $response;

       // return ['articles' => $articletable];
    }
/**
     * @Route("/create-article", name="create_article")
     * @IsGranted("ROLE_ADMIN")
     * @Template
     */
    public function createArticle(request $request)
    {
        $form = $this->createForm(ArticleType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())

       { $article = $form->getData();
        $entityManager = $this->doctrine->getManager();
        $entityManager->persist($article);
        $entityManager->flush();

        $this->addFlash('success', 'votre création d article a bien etais effectué');
     return $this->redirectToRoute('create_article');
    }
        return[
            'form' => $form->createView()
        ];


     /*   $article = new Article();
        $article->setTitle('La cuisine');
        $article->setContent('La cuisine c\'est top');
        $article->setPublicationDate(new \DateTime('2021/03/21 09:01'));
        $article->setImgPath('/sdde');
        $article->setImportant(true);

        $entityManager = $this->doctrine->getManager();
        $entityManager->persist($article);
        $entityManager->flush();

        echo 'ok';
        die; */
    }
/**
     * @Route("/modify-article/{id}", name="modify_article")
     * @Template
     */
    public function modifyArticle( Request $request, int $id)
    {
        $articleRepository = $this->doctrine->getRepository(Article::class);
        $article = $articleRepository->find($id);
        if(!$article){
            throw $this->createNotFoundException('Pas d\'article pour cet id');
        }
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())

       { $article = $form->getData();
        $entityManager = $this->doctrine->getManager();
        $entityManager->flush();

     $this->addFlash('success', 'votre article a bien etais modifié');
     return $this->redirectToRoute('modify_article', [
         'id' => $article->getId()
     ]);
    }
    $form = $this->createForm(ArticleType::class,$article);
    return[
        'form' => $form->createView()
    ];

    }

    /**
     * @Route("/categorie/{categoryId}/article/{articleId}", name="article")
     * @Template
     */
    public function getArticle(int $categoryId, int $articleId): array
    {
        $articleRepository = new ArticleRepository();
        $article = $articleRepository->find($articleId);

        $category = $article->getcategory();
        if ($article) {
            $category = $article->getcategory();
            if ($category->getId() != $categoryId) {
                throw $this->createNotFoundException('l\'article avec cet id');
            }

            return [
                'article' => $article,
            ];
        } else {
            throw $this->createNotFoundException('Pas d\'article avec cet id');
            //return new Response('Pas d\'article avec cet id', 404);
        }

    }
    /**
     * @Route("/categorie/{categoryId}", name="category_articles")
     * @Template
     */
    public function getCategoryArticles(int $categoryId)
    {
        $articleRepository = new ArticleRepository();
        $articles = $articleRepository->findAll();

        $content = '<ul>';

        foreach ($articles as $article) {
            $category = $article->getCategory();
            if ($category->getId() === $categoryId) {
                $content .= '<li>' . $article->getTitle() . '</li>';
            }
            //$content = $content . '<li>'.$article->getTitle().'</li>';
        }
        $content .= '</ul>';

        return new Response($content);
    }
    /**
     * @route ("/categorie/{categoryId}/{page}/", name="articlepage")
     * @Template
     */
    //----------Modifier le contrôleur du point 7, on crée un système de pagination
    public function getArticlePage($page, $categoryId)
    {
        $articleRepository = new ArticleRepository();
        $articles = $articleRepository->findAll();
        foreach ($articles as $article) {
            if ($article->getCategory()->getId() == $categoryId) {
                $articlesCat[] = $article;
            }
        }

        $start = ($page - 1) * 5;
        $end = $start + 4;

        // $articlesToDisplay = array_slice($articlesCat,$start,$end,true);
        for ($i = $start; $i <= $end; $i++) {

            $articlesToDisplay[] = $articlesCat[$i];
            if ($i == count($articlesCat) - 1) {
                break;
            }

        }

        return [
            'articlepage' => $articlesToDisplay,
        ];
    }

}
