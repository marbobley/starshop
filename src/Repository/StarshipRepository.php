<?php
namespace App\Repository;

use App\Model\Starship;
use App\Model\StarshipStatusEnum;
use Psr\Log\LoggerInterface;

class StarshipRepository
{

    public function __construct(private LoggerInterface $logger)
    {
    }

    public function findAll() : Array 
    {
        $this->logger->info('Starship collection retrieved');
        return  [
            new Starship(1, 'USS LeafyCruiser (NCC-0001)', 'Garden', 'Jean-Luc Pickles', StarshipStatusEnum::IN_PROGRESS, new \DateTimeImmutable('2024-01-15 10:00:00')),
            new Starship(2, 'USS Espresso (NCC-1234-C)', 'Latte', 'James T. Quick!', StarshipStatusEnum::COMPLETED, new \DateTimeImmutable('2022-01-15 10:00:00')),
            new Starship(3, 'USS Wanderlust (NCC-2024-W)', 'Delta Tourist', 'Kathryn Journeyway', StarshipStatusEnum::WAITING, new \DateTimeImmutable('2023-01-15 10:00:00')),
        ];
    }

    public function find(int $id): ?Starship
    {
        foreach ($this->findAll() as $starship) {
            if ($starship->getId() === $id) {
                return $starship;
            }
        }

        return null;
    }
}