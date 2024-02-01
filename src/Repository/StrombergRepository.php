<?php

namespace App\Repository;

use App\Entity\Stromberg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Stromberg>
 *
 * @method Stromberg|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stromberg|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stromberg[]    findAll()
 * @method Stromberg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StrombergRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stromberg::class);
    }

//    /**
//     * @return Stromberg[] Returns an array of Stromberg objects
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

//    public function findOneBySomeField($value): ?Stromberg
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
