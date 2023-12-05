<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BlogController extends AbstractController
{  


    #[Route('/blog/articles', name: 'app_blog_articles')]
    public function showArticles(ArticleRepository $repoArticle, CategoryRepository $repoCategory): Response
    {
        $articles=$repoArticle->findAll();
        $categories=$repoCategory->findAll();
      
        return $this->render('blog/index.html.twig', [
            'articles'=>$articles,
            'categories'=>$categories,
        ]);
    }
    #[Route('/article/{slug}', name: 'app_single_article')]
    public function single(ArticleRepository $repoArticle, CategoryRepository $repoCategory, string $slug): Response{

        $article = $repoArticle->findOneBySlug($slug);
        $categories=$repoCategory->findAll();

        return $this->render('blog/single.html.twig',['article' => $article, 'categories'=>$categories]);
    }

    #[Route('/article/categories/{slug}', name: 'app_articles_by_category')]
    public function singleCat(CategoryRepository $repoCategory, string $slug): Response{

        $categories = $repoCategory->findAll();
        $category = $repoCategory->findOneBySlug($slug);

        $articles = [];

        if($category){
            $articles = $category->getArticles();
        }

        return $this->render('blog/articles_by_category.html.twig', [
            'articles' => $articles,
            'category' => $category,
            'categories' => $categories, 
            'slug' => $slug
        ]);
    }
    
   
    
    
    #[Route('/article/{id}', name: 'app_single_article_id')]
    public function singleId(ArticleRepository $repoArticle, $id): Response{
        $article = $repoArticle->findOneById($id);
        
        return $this->render('blog/single.html.twig',['article' => $article]);
    }
    
    #[Route('/', name: 'app_blog_hello')]
    public function index(): Response
    {
        return new Response('Hello World!');
    }
}


