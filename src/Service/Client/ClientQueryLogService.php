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


}
