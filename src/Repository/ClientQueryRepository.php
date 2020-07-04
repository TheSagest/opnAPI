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


}
