<?php

namespace App\Service;



use App\Entity\Client;
use App\Entity\IPList;
use Doctrine\ORM\EntityManagerInterface;

class IPListService
{

    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    public function getIPsByListType(Client $client, string $listType) :?IPList
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('i');
        $qb->from(IPList::class, 'i');
        $qb->andWhere('i.client = :client' );
        $qb->setParameter('client', $client);
        $qb->andWhere('i.listType = :list' );
        $qb->setParameter('list', $listType);

        return $qb->getQuery()->getOneOrNullResult();
//        return array_map('current', $result);


    }
}
