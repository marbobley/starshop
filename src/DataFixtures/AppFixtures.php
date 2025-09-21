<?php

namespace App\DataFixtures;

use App\Entity\Droid;
use App\Entity\Starship;
use App\Entity\StarshipPart;
use App\Factory\DroidFactory;
use App\Factory\StarshipFactory;
use App\Factory\StarshipPartFactory;
use App\Model\StarshipStatusEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ship3 =StarshipFactory::createOne([
            'name' => 'USS LeafyCruiser (NCC-0001)',
            'class' => 'Garden',
            'captain' => 'Jean-Luc Pickles',
            'status' => StarshipStatusEnum::IN_PROGRESS,
            'arrivedAt' => new \DateTimeImmutable('-1 day'),
        ]);
        $ship2 =StarshipFactory::createOne([
            'name' => 'USS Espresso (NCC-1234-C)',
            'class' => 'Latte',
            'captain' => 'James T. Quick!',
            'status' => StarshipStatusEnum::COMPLETED,
            'arrivedAt' => new \DateTimeImmutable('-1 week'),
        ]);

        $ship1 = StarshipFactory::createOne([
            'name' => 'USS Wanderlust (NCC-2024-W)',
            'class' => 'Delta Tourist',
            'captain' => 'Kathryn Journeyway',
            'status' => StarshipStatusEnum::WAITING,
            'arrivedAt' => new \DateTimeImmutable('-1 month'),
        ])->_real();

        $starship = new Starship();
        $starship->setName('USS Taco Tuesday');
        $starship->setClass('Tex-Mex');
        $starship->checkIn();
        $starship->setCaptain('James T. Nacho');
        $manager->persist($starship);

        $part = new StarshipPart();
        $part->setStarship($starship);
        $part->setName('spoiler');
        $part->setNotes('There\'s no air drag in space, but it looks cool.');
        $part->setPrice(500);
        $manager->persist($part);
        $manager->flush();

        StarshipFactory::createMany(50);
        StarshipPartFactory::createMany(100);
        StarshipPartFactory::createMany(100, [
            'starship' => $starship,
        ]);
        DroidFactory::createMany(100);

        $starshipPart = StarshipPartFactory::createOne([
            'name' => 'Toilet Paper',
            'starship' => $ship1,
        ])->_real();

        $ship1->removePart($starshipPart);
        $manager->flush();

        $droid1 = new Droid();
        $droid1->setName('IHOP-123');
        $droid1->setPrimaryFunction('Pancake chef');
        //$droid1->addStarship($ship1);
        $ship1->addDroid($droid1);
        $manager->persist($droid1);
        $droid2 = new Droid();
        $droid2->setName('D-3P0');
        $droid2->setPrimaryFunction('C-3PO\'s voice coach');
        $ship2->addDroid($droid2);
        $manager->persist($droid2);
        $droid3 = new Droid();
        $droid3->setName('BONK-5000');
        $droid3->setPrimaryFunction('Comedy sidekick');
        $ship3->addDroid($droid3);
        $ship3->addDroid($droid2);
        $ship3->addDroid($droid1);
        $manager->persist($droid3);
        $manager->flush();
    }
}
