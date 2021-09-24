<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UpdateUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'profil')]
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = $this -> getUser();
        $form = $this -> createForm(UpdateUserType::class, $user);

        $form -> handleRequest($request);
        if ($form -> isSubmitted() && $form -> isValid())
        {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $manage = $this -> getDoctrine() -> getManager();

            $manage -> persist($user);
            $manage -> flush();

            $this -> addFlash('message', 'Votre profil à bien été mise à jour');
            return $this -> redirect('/logout');
        }


        return $this->render('profil/profil.html.twig', [
            'controller_name' => 'ProfilController',
            'updateForm' => $form -> createView()
        ]);
    }
}
