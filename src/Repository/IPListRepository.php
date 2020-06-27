<?php

namespace App\Repository;

use App\Entity\IPList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\String_;

/**
 * @method IPList|null find($id, $lockMode = null, $lockVersion = null)
 * @method IPList|null findOneBy(array $criteria, array $orderBy = null)
 * @method IPList[]    findAll()
 * @method IPList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IPListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IPList::class);
    }

}
