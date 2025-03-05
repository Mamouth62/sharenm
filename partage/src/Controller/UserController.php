<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/liste-users', name: 'app_liste_users')]
    public function listeUsers(EntityManagerInterface $entityManager): Response
    {
        // Récupérer tous les utilisateurs de la base de données
        $users = $entityManager->getRepository(User::class)->findAll();

        // Passer les utilisateurs au template Twig
        return $this->render('user/liste-user.html.twig', [
            'users' => $users,
        ]);
    }
}
