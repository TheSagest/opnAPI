<?php

namespace App\Service;

use App\Entity\Client;
use App\Module\RemoteAPI\FirewallAlias;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;


class OpnSenseStatusService
{

    public $opnStatus;
    private $firewallAlias;
    private $clients;
    private $em;


    public function __construct(ClientRepository $clients,
                                OpnSenseFirmwareAPI $firmware,
                                FirewallAlias $firewallAlias,
                                EntityManagerInterface $em
)
    {
        $this->clients = $clients;
        $this->opnStatus = $firmware;
        $this->firewallAlias = $firewallAlias;
        $this->em = $em;
    }

    public function updateFirmwareVersion()
    {
        // Loop through Each client and update the Vs, and the date checked.
        $clients = $this->clients->scanClients();

        foreach ($clients as $client){
            dump($client->getClientName() );
            $this->persistFirmwareData($client);
            $this->persistAliasStatus($client);

        }
    }

    public function persistFirmwareData(Client $client){

         $this->setFirmwareHeaders($client);


        $firmwareStatusResponse = $this->opnStatus->firmware()->status();
        dump(' Firmware Vs.');
        $client->setProductVersion( $firmwareStatusResponse->getProductVersion());

        $this->em->flush();
    }

    public function persistAliasStatus(Client $client){

        $this->setAliasHeaders($client);


        $firmwareStatusResponse = $this->firewallAlias->getAliasUUID($client->getLocalNetworkAliasName())->uuid;

        $result = $this->firewallAlias->getItem($firmwareStatusResponse);

        if($result->alias->enabled == '1'){
            $result = 'Off';
        } else {
            $result= 'On';
        }
        dump(' Alias Status.');
        $client->setFirewallOn($result);

        $this->em->flush();
    }

    public function getLocalNetworkAliasStatus(){

        $myClient = [];

        $clients = $this->clients->findAll();


        foreach ($clients as $client){

            $myRow = [];
            $myRow['id'] = $client->getId();
            $myRow['name'] = $client->getClientName();

            $myRow ['firmwareVs'] = $client->getProductVersion();

            if ($client->getScanForUp()){
                $myRow['aliasEnabled'] = $this->getAliasStatus($client);
            }else{
                $myRow['aliasEnabled'] = 'N/A';
            }


            $myRow['notes'] = $client->getNotes();

            array_push($myClient,  $myRow);

        }

        return $myClient ;

    }

    private function getAliasStatus(Client $client){
        $this->setFirmwareHeaders($client);
        return $this->firewallAlias->aliasEnabled($client->getLocalNetworkAliasName());
    }

    public function setFirmwareHeaders($client){
        // Common function to set headers for for API call

        $this->opnStatus->setHost($client->getIpAddress());
        $this->opnStatus->setKey($client->getApiKey());
        $this->opnStatus->setSecret($client->getApiSecret());
        $this->opnStatus->setPort($client->getPort());

        $prefix = "http://";
        if ($client->getHttps()){
            $prefix = "https://";
        }
        $this->opnStatus->setPrefix($prefix);

    }

    protected function setAliasHeaders($client){
        // Common function to set headers for for API call

        $this->firewallAlias->setHost($client->getIpAddress());
        $this->firewallAlias->setKey($client->getApiKey());
        $this->firewallAlias->setSecret($client->getApiSecret());
        $this->firewallAlias->setPort($client->getPort());

        $prefix = "http://";
        if ($client->getHttps()){
            $prefix = "https://";
        }
        $this->firewallAlias->setPrefix($prefix);

    }

    public function downloadFirmware(Client $client){
        $this->setFirmwareHeaders($client);


    }
}