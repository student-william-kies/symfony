<?php

namespace App\Controller;

use App\Entity\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        $repo = $this -> getDoctrine() -> getRepository(BlogPost::class);
        $last_posts = $repo -> findBy([], ['id' => 'desc'], 3);

        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
            'lastPosts' => $last_posts
        ]);
    }
}
