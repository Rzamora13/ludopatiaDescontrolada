<?php

namespace App\Repository;

use App\Entity\Apuesta;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Apuesta>
 *
 * @method Apuesta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apuesta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apuesta[]    findAll()
 * @method Apuesta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApuestaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apuesta::class);
    }

    public function getMaxTotalApuestas(): ?int
{
    $qb = $this->createQueryBuilder('a')
        ->select('IDENTITY(a.user) as userId')
        ->groupBy('a.user')
        ->orderBy('COUNT(a.id)', 'DESC')
        ->setMaxResults(1);

    $result = $qb->getQuery()->getOneOrNullResult();

    return $result['userId'] ?? null;
}

    
   /**
    * @return Apuesta[] Returns an array of Apuesta objects
    */
   public function getAvailableTickets($sorteoId): array
   {
       return $this->createQueryBuilder('a')
           ->andWhere('a.sorteo = :val AND a.user IS NULL')
           ->setParameter('val', $sorteoId)
           ->orderBy('a.id', 'DESC')
           ->getQuery()
           ->getResult()
       ;
   }
    

    


//    /**
//     * @return Apuesta[] Returns an array of Apuesta objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Apuesta
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
