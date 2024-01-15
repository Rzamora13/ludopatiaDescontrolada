<?php

namespace App\Repository;

use App\Entity\SORTEO;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SORTEO>
 *
 * @method SORTEO|null find($id, $lockMode = null, $lockVersion = null)
 * @method SORTEO|null findOneBy(array $criteria, array $orderBy = null)
 * @method SORTEO[]    findAll()
 * @method SORTEO[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SORTEORepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SORTEO::class);
    }

//    /**
//     * @return SORTEO[] Returns an array of SORTEO objects
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

//    public function findOneBySomeField($value): ?SORTEO
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
