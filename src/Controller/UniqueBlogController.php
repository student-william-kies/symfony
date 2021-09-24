<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UniqueBlogController extends AbstractController
{
    #[Route('/blog/{id}', name: 'unique_blog')]
    public function index(BlogPost $post): Response
    {
        $this -> redirectToRoute('unique_blog', ['id' => $post -> getId()]);

        return $this->render('unique_blog/unique_blog.html.twig', [
            'controller_name' => 'UniqueBlogController',
            'post' => $post
        ]);
    }
}
