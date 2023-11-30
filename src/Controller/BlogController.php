<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BlogController extends AbstractController
{  


    #[Route('/blog/articles', name: 'app_blog_articles')]
    public function showArticles(ArticleRepository $repoArticle): Response
    {
        $articles=$repoArticle->findAll();
       // dd($articles);
        return $this->render('blog/index.html.twig', [
            'articles'=>$articles
        ]);
    }

}

