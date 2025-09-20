<?php

namespace App\DataFixtures;

use App\Entity\Starship;
use App\Model\StarshipStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ship = new Starship();
        $ship->setName('USS Enterprise');
        $ship->setClass('Explorer');
        $ship->setCaptain('James T. Kirk');
        $ship->setStatus(StarshipStatusEnum::IN_PROGRESS);
        $ship->setArrivedAt(new \DateTimeImmutable('2023-09-20 10:00:00'));

        $ship2 = new Starship();
        $ship2->setName('USS Espresso (NCC-1234-C)');
        $ship2->setClass('Latte');
        $ship2->setCaptain('James T. Quick!');
        $ship2->setStatus(StarshipStatusEnum::COMPLETED);
        $ship2->setArrivedAt(new \DateTimeImmutable('-1 week'));
        $ship3 = new Starship();
        $ship3->setName('USS Wanderlust (NCC-2024-W)');
        $ship3->setClass('Delta Tourist');
        $ship3->setCaptain('Kathryn Journeyway');
        $ship3->setStatus(StarshipStatusEnum::WAITING);
        $ship3->setArrivedAt(new \DateTimeImmutable('-1 month'));
        
        $manager->persist($ship);
        $manager->persist($ship2);
        $manager->persist($ship3);

        $manager->flush();
    }
}
