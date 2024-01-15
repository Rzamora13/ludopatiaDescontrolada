<?php

namespace App\Repository;

use App\Entity\TICKET;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TICKET>
 *
 * @method TICKET|null find($id, $lockMode = null, $lockVersion = null)
 * @method TICKET|null findOneBy(array $criteria, array $orderBy = null)
 * @method TICKET[]    findAll()
 * @method TICKET[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TICKETRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TICKET::class);
    }

//    /**
//     * @return TICKET[] Returns an array of TICKET objects
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

//    public function findOneBySomeField($value): ?TICKET
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
