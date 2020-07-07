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
                                OpnSenseFWStatusAPI $firmware,
                                FirewallAlias $firewallAlias,
                                EntityManagerInterface $em
    )
    {
        $this->clients = $clients;
        $this->opnStatus = $firmware;
        $this->firewallAlias = $firewallAlias;
        $this->em = $em;
    }

    // Loop through ALL clients and update Alias an dsFirmware Versions
    // Called from Command on a CRON job.
    // Use refreshClientFirewallStatus or persistFirmweareData for individual Clients
    public function refreshAllFirewallStatus()
    {
        // Loop through Each client and update the Firmware Vs, Firewall Status.
        $clients = $this->clients->scanClients();

        foreach ($clients as $client) {
            dump ($client->getClientName());
            $this->refreshClientFirewallStatus($client);
        }
    }

    // Call to update both Firmware Version and Firewall status
    public function refreshClientFirewallStatus(Client $client)
    {
            $this->persistFirmwareData($client);
            $this->persistAliasStatus($client);
    }

    // Save Firmware Version to Database
    public function persistFirmwareData(Client $client){

        $this->setFirmwareHeaders($client);

        $firmwareStatusResponse = $this->opnStatus->firmware()->info() ;
        $client->setProductVersion( $firmwareStatusResponse-> getVersion());
        $this->em->flush();
    }

    // Save Alias state to Database
    public function persistAliasStatus(Client $client){

        $this->setAliasHeaders($client);

        $firmwareStatusResponse = $this->firewallAlias->getAliasUUID($client->getLocalNetworkAliasName())->uuid;

        $result = $this->firewallAlias->getItem($firmwareStatusResponse);

        if($result->alias->enabled == '1'){
            $result = 'Off';
        } else {
            $result= 'On';
        }
//        dump(' Alias Status.');
        $client->setFirewallOn($result);

        $this->em->flush();
    }

    // Common function to set headers for for API call
    public function setFirmwareHeaders($client){


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

    // Common function to set headers for for API call
    protected function setAliasHeaders($client){


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

    // Refresh Aliases for Client
    public function refreshAliases(Client $client){
        //  api/firewall/alias/reconfigure

        $this->setAliasHeaders($client);
        $firmwareStatusResponse = $this->firewallAlias->reconfigure();
    }
}
