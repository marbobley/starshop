<?php

namespace App\Controller;

use App\Entity\Starship;
use App\Model\StarshipStatusEnum;
use App\Repository\StarshipRepository;
use Doctrine\ORM\EntityManagerInterface;
use Dom\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(
        StarshipRepository $starshipRepository,
    ): Response {
        $ships = $starshipRepository->findAll();
        $myShip = $ships[array_rand($ships)];

        return $this->render('main/homepage.html.twig', [
            'myShip' => $myShip,
            'ships' => $ships,
        ]);
    }

    #[Route('/dql', name: 'app_homepage_direct_query')]
    public function homepage_direct_query(
        StarshipRepository $starshipRepository,
        EntityManagerInterface $entityManager,
    ): Response {
        $ships = $entityManager->createQueryBuilder()
            ->select('s')
            ->from(Starship::class, 's')
            ->getQuery()
            ->getResult();
        //$ships = $starshipRepository->findAll();
        $myShip = $ships[array_rand($ships)];

        return $this->render('main/homepage.html.twig', [
            'myShip' => $myShip,
            'ships' => $ships,
        ]);
    }

    #[Route('/find', name: 'app_homepage_find')]
    public function homepage_find(
        StarshipRepository $starshipRepository
    ): Response {
        $ships = $starshipRepository->findNotInStatus(StarshipStatusEnum::COMPLETED);
        $myShip = $ships[array_rand($ships)];

        return $this->render('main/homepage.html.twig', [
            'myShip' => $myShip,
            'ships' => $ships,
        ]);
    }
}
