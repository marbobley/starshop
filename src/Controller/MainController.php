<?php

namespace App\Controller;

use App\Repository\StarshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(StarshipRepository $starshipRepository,
     HttpClientInterface $http,
      CacheInterface $issLocationPool,      
        #[Autowire(param: 'iss_location_cache_ttl')]
        $issLocationCacheTtl
        ): Response
    {
        $ships = $starshipRepository->findAll();
        $myShip = $ships[array_rand($ships)];

        $issData = $issLocationPool->get('iss_location_data', function (ItemInterface $item) use ($http): array {
            $response = $http->request('GET', 'https://api.wheretheiss.at/v1/satellites/25544');

            return $response->toArray();
        });
            dd($issLocationCacheTtl);

        return $this->render('main/homepage.html.twig', [
            'myShip' => $myShip,
            'ships' => $ships,
            'issData' => $issData,
        ]);
    }
}
