<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Form\CreatingBlogType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreatingBlogController extends AbstractController
{
    #[Route('/creating_blog', name: 'creating_blog')]
    public function index(Request $request): Response
    {
        $post = new BlogPost();
        $form = $this -> createForm(CreatingBlogType::class, $post);

        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid())
        {
            $date = new \DateTime();
            $date -> format('d-m-Y H-s-m');

            $post -> setCreatedAt($date);

            $entityManager = $this -> getDoctrine() -> getManager();
            $entityManager -> persist($post);
            $entityManager -> flush();

            $this -> redirect('/');
        }

        return $this->render('creating_blog/creating_blog.html.twig', [
            'controller_name' => 'CreatingBlogController',
            'postForm' => $form -> createView(),
        ]);
    }
}
