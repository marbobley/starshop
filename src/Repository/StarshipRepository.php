<?php

namespace App\Repository;

use App\Entity\Starship;
use App\Model\StarshipStatusEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Starship>
 */
class StarshipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Starship::class);
    }

    public function findNotInStatus(StarshipStatusEnum $starshipStatusEnum): array
    {
        return $this->createQueryBuilder('s')
            ->where('s.status != :status')
            ->orderBy('s.arrivedAt', 'DESC')
            ->setParameter('status', $starshipStatusEnum)
            ->getQuery()
            ->getResult()
        ;        
    }

//    /**
//     * @return Starship[] Returns an array of Starship objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Starship
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
