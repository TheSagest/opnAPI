<?php

namespace App\Service\Client;

use App\Entity\ClientQuery;
use Doctrine\ORM\EntityManagerInterface;

class ClientQueryLogService
{
    private $em;

    public function __construct( EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function logCall (string $clientId, string $listName, string $ip){
        $newQuery = new ClientQuery();


        $newQuery->setClientID($clientId);
        $newQuery->setIPListName($listName);
        $newQuery->setIPaddress($ip);
        $dt = date('Y-m-d H:i:s');
        $newQuery->setTimeQueried(strtotime($dt));

        $this->em->persist($newQuery);
        $this->em->flush();


    }
}
