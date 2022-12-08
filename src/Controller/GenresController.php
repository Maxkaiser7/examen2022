<?php

namespace App\Controller;

use App\Entity\Chansons;
use App\Entity\Genres;
use App\Form\ChansonsType;
use App\Form\GenresType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenresController extends AbstractController
{
    #[Route('/genres', name: 'genres')]
    public function index(EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Genres::class);
        $genres = $repository->findAll();

        return $this->render('/genres/afficherGenres.html.twig', [
            'genres' => $genres
        ]);
    }
    #[Route('/genres/ajouter', name: 'genreAjouter')]
    public function genreAjouter(Request $request, EntityManagerInterface $entityManager)
    {
        $genre = new Genres();
        $form = $this->createForm(GenresType::class, $genre);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid())
        {
            $genre = $form->getData();
            $entityManager->persist($genre);
            $entityManager->flush();

            return $this->redirectToRoute('genres');
        }
        return $this->renderForm('chansons/ajouter.html.twig', [
            'form' => $form
        ]);

    }
}
