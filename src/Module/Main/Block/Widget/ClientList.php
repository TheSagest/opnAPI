<?php


namespace App\Module\Main\Block\Widget;

use App\Entity\Client;
use Symfony\Component\Routing\RouterInterface;
use App\Module\Block\AbstractBlock;
use App\Repository\ClientRepository;

class ClientList extends AbstractBlock {

    private $clientRespository;
    private $router;

    public function __construct(ClientRepository $clientRepository,
        RouterInterface $router)
    {
        $this->clientRespository = $clientRepository;
        $this->router = $router;
    }

    public function getClients (){
        return $this->clientRespository->findAll();
    }

    public function editClientLink(Client $client){

        return $this->router->generate('edit_client', [
            "client" => $client->getId()
        ]);

    }
}
