<?php

namespace App\Controller;

use App\Entity\Fichier;
use App\Entity\User;
use App\Form\FichierType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; // Assurez-vous d'importer la bonne annotation
use Symfony\Component\Routing\Annotation\Route;

final class FichierController extends AbstractController
{
    #[Route('/ajout-fichier', name: 'app_ajout_fichier')]
    public function fichier(Request $request, EntityManagerInterface $entityManager): Response
    {

        $fichier = new Fichier();

        $form = $this->createForm(FichierType::class, $fichier);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($fichier);
            $entityManager->flush();

            $this->addFlash('success', 'Fichier ajouté avec succès !');
            return $this->redirectToRoute('app_ajout_fichier');
        }

        return $this->render('fichier/ajout-fichier.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/liste-fichiers', name: 'app_liste_fichiers')]
    public function listeFichiers(EntityManagerInterface $entityManager): Response
    {
        
        $fichiers = $entityManager->getRepository(Fichier::class)->findAll();

        
        return $this->render('fichier/liste-fichiers.html.twig', [
            'fichiers' => $fichiers,
        ]);
    }
    #[Route('/liste-fichiers-utilisateurs', name: 'app_liste_fichiers_utilisateurs')]
    public function listeFichiersUtilisateurs(EntityManagerInterface $entityManager): Response
    {
        
        $users = $entityManager->getRepository(User::class)->findAll();
        return $this->render('fichier/liste-fichiers-utilisateurs.html.twig', [
            'users' => $users,
        ]);
    }
}
