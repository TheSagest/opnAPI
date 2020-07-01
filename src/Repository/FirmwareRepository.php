<?php

namespace App\Repository;

use App\Entity\Firmware;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Firmware|null find($id, $lockMode = null, $lockVersion = null)
 * @method Firmware|null findOneBy(array $criteria, array $orderBy = null)
 * @method Firmware[]    findAll()
 * @method Firmware[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FirmwareRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Firmware::class);
    }

    // /**
    //  * @return Firmware[] Returns an array of Firmware objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Firmware
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
