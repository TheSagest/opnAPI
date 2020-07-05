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

//    public function numberOfDaysUnqueried(){
//
//        return
//            $this
//                ->createQueryBuilder('api')
//                ->select('COUNT(api.dateQueried) AS api')
//                ->andWhere(api.dateQueried < DATE_SUB(now(), 2) )
//                ->getQuery()
//                ->getResult(Query::HYDRATE_SCALAR);
//
//    }

}
