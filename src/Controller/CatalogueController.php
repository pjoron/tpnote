<?php

namespace App\Controller;

use App\Repository\AppartementRepository;
use App\Repository\LieuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class CatalogueController extends AbstractController
{
    #[Route('/', name: 'app_catalogue')]
    public function index(Request $request, AppartementRepository $appartementRepository, LieuRepository $lieuRepository): Response
    {
        $ville = $request->query->get('ville');

        if (!$ville) {
            $appartements = $appartementRepository->findAll();
        } else {
            $lieu = $lieuRepository->findOneBy(['ville' => $ville]);

            if (!$lieu) {
                throw $this->createNotFoundException('Cette ville n\'existe pas.');
            }

            $appartements = $appartementRepository->findByLieu($lieu);
        }

        $lieux = $lieuRepository->findAll();

        return $this->render('catalogue/index.html.twig', [
            'controller_name' => 'CatalogueController',
            'appartements' => $appartements,
            'lieux' => $lieux,
        ]);
    }
}
