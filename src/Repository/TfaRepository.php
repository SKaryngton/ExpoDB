<?php

namespace App\Repository;

use App\Entity\Tfa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tfa>
 *
 * @method Tfa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tfa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tfa[]    findAll()
 * @method Tfa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TfaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tfa::class);
    }

//    /**
//     * @return Tfa[] Returns an array of Tfa objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Tfa
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
