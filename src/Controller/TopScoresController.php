<?php

namespace App\Controller;

use App\Form\ListeJeuxForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TopScoresController extends AbstractController
{
    #[Route('/topscores', name: 'app_top_scores')]
    public function index(Request $request): Response
    {
        $formListJeux = $this->createForm(ListeJeuxForm::class);
        $formListJeux->handleRequest($request);

        if ($formListJeux->isSubmitted() && $formListJeux->isValid()) {
            $jeu = $formListJeux->get('jeux')->getData();
            dd($jeu);
        }

        return $this->render('top_scores/index.html.twig', [
            'formListJeux' => $formListJeux,
        ]);
    }
}
