<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]
    public function index(): Response
    {
        $repo = $this -> getDoctrine() -> getRepository(BlogPost::class);
        $posts = $repo -> findAll();

        return $this->render('blog/blog.html.twig', [
            'controller_name' => 'BlogController',
            'posts' => $posts
        ]);
    }
}
