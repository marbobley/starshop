<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\StarshipRepository;

#[Route('/api/starships')]
class StarshipApiController extends AbstractController
{
    #[Route('', name: 'api_starship_collection', methods: ['GET'])]
    public function getCollection( StarshipRepository $starshipRepository): Response
    {       
        return $this->json($starshipRepository->findAll());
    }

    #[Route('/{id<\d+>}', name: 'api_starship_get', methods: ['GET'])]
    public function get(StarshipRepository $starshipRepository, int $id): Response
    {
        $starship = $starshipRepository->find($id);

        if(!$starship) {            
            throw $this->createNotFoundException('Starship not found');
        }

        return $this->json($starship);
    }
}
