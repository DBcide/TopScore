<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Entity\Partie;
use App\Form\ListeJeuxForm;
use DateTime;
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

        $scores = $entityManager->getRepository(Partie::class)->findScoresByGameCurrentMonth(['jeu' => $jeu]);
        
        $first = null;
        $second = null;
        $third = null;

        $i = 0;
        foreach ($scores as $key => $score) {
            if ($i == 0) {
                $first = $score;
            }
            if ($i == 1) {
                $second = $score;
            }
            if ($i == 2) {
                $third = $score;
            }
            $i++;
        }

        return $this->render('top_scores/index.html.twig', [
            'formListJeux' => $formListJeux,
            'scores' => $scores,
            'first' => $first,
            'second' => $second,
            'third' => $third,
            'jeu' => $jeu,
        ]);
    }
}
