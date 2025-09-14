<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Model\Starship;
use Psr\Log\LoggerInterface;

class StarshipApiController extends AbstractController
{
    #[Route('/api/starships')]
    public function getCollection(LoggerInterface $logger): Response
    {
        $starships = [
            new Starship(1, 'USS LeafyCruiser (NCC-0001)', 'Garden', 'Jean-Luc Pickles', 'taken over by Q'),
            new Starship(2, 'USS Espresso (NCC-1234-C)', 'Latte', 'James T. Quick!', 'repaired'),
            new Starship(3, 'USS Wanderlust (NCC-2024-W)', 'Delta Tourist', 'Kathryn Journeyway', 'under construction'),
        ];
                    
        $logger->info('Starship collection retrieved');

        return $this->json($starships);
    }
}
