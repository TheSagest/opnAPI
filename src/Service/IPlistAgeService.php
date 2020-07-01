<?php

namespace App\Service;


use App\Repository\ClientQueryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\EndpointUpService;

class IPlistAgeService
{

    private $entityManager;
    private $clientQuery;
    private $listArray;
    private $clientID;
    private $listName;

    private $endpoint;

    public function __construct(
        EntityManagerInterface $entityManager,
        ClientQueryRepository $clientQueryRepository,
        EndpointUpService $endpoint
    )
    {
        $this->entityManager = $entityManager;
        $this->clientQuery = $clientQueryRepository;
        $this->endpoint = $endpoint;
    }

        public function setListCredentials( string $clientID, string $listName) : void
    {
        $this->clientID = $clientID;
        $this->listName = $listName;

        $this->listArray = $this->clientQuery->findBy([
                'clientID' => $this->clientID,
                'IPListName' => $this->listName]);

    }

    public function getLatestQuery (){

        $qb = null;

        if ($this->clientID){
            $qb = $this->clientQuery->createQueryBuilder('l');
            $qb->select('l, MAX(l.timeQueried) as latestQuery');
            $qb->andWhere('l.clientID = :cID' );
            $qb->andWhere('l.IPListName = :lName');
            $qb->setParameter('cID', $this->clientID);
            $qb->setParameter('lName', $this->listName);
        }
        return $qb->getQuery()->execute();


    }

    public function getCount() :int {
        if (!$this->listName){
            $count = 0;
        }
        else
        {
            $count = count($this->listArray);
        }
        return $count;
    }

    public function getLatest() {
        if (!$this->listName){
            $latestQuery = 0;
        }
        else
        {
            $latestQuery = count($this->listArray);
        }
    }
}