<?php

namespace App\Repository;

use App\Entity\ClientQuery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClientQuery|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientQuery|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientQuery[]    findAll()
 * @method ClientQuery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class ClientQueryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientQuery::class);
    }

    public function deleteOldQueries() :int {

        $date = new \DateTime();
        $date->modify('-7  days');



        $qb = $this->createQueryBuilder('q' );

         $qb->delete();
         $qb->andWhere('q.timeQueried < :date');
         $qb->setParameter(':date', $date->getTimestamp());

         // Return number deleted
         return  $qb->getQuery()->getScalarResult() ;

    }


    // /**
    //  * @return ClientQuery[] Returns an array of ClientQuery objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ClientQuery
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
