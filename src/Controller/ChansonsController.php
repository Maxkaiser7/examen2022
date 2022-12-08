<?php

namespace App\Controller;

use App\Entity\Chansons;
use App\Form\ChansonsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ChansonsRepository;

class ChansonsController extends AbstractController
{
    #[Route('/chansons', name: 'chansons')]
    public function afficher(EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Chansons::class);
        $chansons = $repository->findAll();

        return $this->render('base.html.twig', [
            'chansons' => $chansons
        ]);
    }

    #[Route('/chansons/afficheUne/{id}', name: 'afficherUne')]
    public function afficherUneChanson($id, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Chansons::class);
        $chansons = $repository->find($id);

        return $this->render('chansons/afficherUne.html.twig', [
            'chansons' => $chansons
        ]);
    }
    #[Route('/chansons/ajouter', name: 'chansonsAjouter')]
    public function chansonsAjouter(Request $request, EntityManagerInterface $entityManager)
    {
        $chanson = new Chansons();
        $chanson->setDateAjout(new \DateTime());
        $form = $this->createForm(ChansonsType::class, $chanson);
        $form->handleRequest($request);

        if ( $form->isSubmitted() && $form->isValid())
        {
            $chanson = $form->getData();
            $entityManager->persist($chanson);
            $entityManager->flush();

            return $this->redirectToRoute('afficherUne', [
                'id' => $chanson->getId(),
            ]);
        }
        return $this->renderForm('chansons/ajouter.html.twig', [
           'form' => $form
        ]);

    }

    #[Route('/chansons/afficherParGenre/{id}', name: 'afficherParGenre')]
    public function chansonsParGenre($id, EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Chansons::class);
        $chansons = $repository->findByGenre($id);

        return $this->render('base.html.twig', [
            'chansons' => $chansons
        ]);
    }

}
