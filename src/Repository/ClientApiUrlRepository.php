<?php

namespace App\Repository;

use App\Entity\ClientApiUrl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClientApiUrl|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientApiUrl|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClientApiUrl[]    findAll()
 * @method ClientApiUrl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientApiUrlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientApiUrl::class);
    }

    // /**
    //  * @return ClientApiUrl[] Returns an array of ClientApiUrl objects
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
    public function findOneBySomeField($value): ?ClientApiUrl
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
