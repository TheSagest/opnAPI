<?php

namespace App\Service;

// We just want to delete Entries older that 7 days from the Client Query Table
// ALSO delete Old Firmwares ONLY if there is already one


use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;

class EndpointUpService
{
    private $client ;
    private $em;

    public function __construct(
        ClientRepository $client,
        EntityManagerInterface $entityManager
    )
    {
        $this->client = $client;
        $this->em = $entityManager;
    }

    private function getEndpointUpStatus( string $url, $port ) :bool {
        $timeout = 2;

        $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt ( $ch, CURLOPT_URL, 'https://'.$url . ':' . $port );
            curl_setopt($ch, CURLOPT_NOBODY  , true);
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );

        $response = curl_exec($ch);

        $http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        curl_close( $ch );

        if ( ( $http_code == "200" ) || ( $http_code == "302" ) || ( $http_code == "403" )) {
            return true;
        } else {
            // you can return $http_code here if necessary or wanted
            return false;
        }

    }

    public function  isUp ( string $clientGUID) :bool {

        /** @var Client $client */
        $client = $this->client->findOneBy(['id' => $clientGUID]);
        $url = $client->getIpAddress();
        $port = $client->getPort();

        if (!$url){
            return false;
        } else {
            return $this->getEndpointUpStatus($url, $port);
        }



    }
}
