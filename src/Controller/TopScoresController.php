<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Entity\Partie;
use App\Form\ListeJeuxForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TopScoresController extends AbstractController
{
    #[Route('/topscores/{id}', name: 'app_top_scores')]
    public function index(Request $request, $id, EntityManagerInterface $entityManager): Response
    {
        $jeu = $entityManager->getRepository(Jeu::class)->find($id);

        $formListJeux = $this->createForm(ListeJeuxForm::class);
        $formListJeux->handleRequest($request);

        if ($formListJeux->isSubmitted() && $formListJeux->isValid()) {
            $jeu = $formListJeux->get('jeux')->getData();

            return $this->redirectToRoute('app_top_scores', ['id' => $jeu->getId()]);
        }

        $scores = $entityManager->getRepository(Partie::class)->findBy(['jeu' => $jeu]);
        dd($scores);

        return $this->render('top_scores/index.html.twig', [
            'formListJeux' => $formListJeux,
        ]);
    }
}
