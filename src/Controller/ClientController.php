<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;

use App\Module\RemoteAPI\FirewallAlias;
use App\Service\OpnSenseFWStatusAPI;
use App\Service\OpnSenseStatusService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class ClientController extends AbstractController
{

    private $entityManager;
    private $opnsense;
    private $firewallAlias;
    private $OStatusService;

    public function __construct(EntityManagerInterface $entityManager,
                                OpnSenseFWStatusAPI $sense,
                                FirewallAlias $firewallAlias,
                                OpnSenseStatusService $OStatusService

    )
    {
        $this->entityManager = $entityManager;
        $this->opnsense = $sense;
        $this->firewallAlias = $firewallAlias;
        $this->OStatusService = $OStatusService;

    }

     /**
     * @Route("/createClient", name="create_client")
     */
    public function createClient(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $client = new Client();

        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('list_clients');
        }

        return $this->render('client/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/listClient", name="list_clients")
     */
    public function listClients()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository(Client::class)->findAll();

        return $this->render('client/list.html.twig', [
            'clients' => $client,
        ]);
    }

     /**
     * @Route("/deleteClient/{client}", name="delete_client")
     */
    public function deleteClient(Client $client )
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();

        $em->remove($client);
        $em->flush();

        $this->addFlash('info', 'deleted '.$client->getClientName());

        return $this->redirectToRoute('list_clients');

    }

    /**
     * @Route("/editClient/{client}", name="edit_client")
     * @param Client $client
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editClient(Client $client, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

	    $em = $this->getDoctrine()->getManager();

    	$form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Save
            $client = $form->getData();
            $em->flush();

            return $this->redirectToRoute('list_clients');
        }

        return $this->render('client/edit.html.twig', [
            'form' => $form->createView(),
            'firmwares' => $client->getFirmware(),
        ]);
    }

    /**
     * @Route("/toggleFirewall/{client}", name="toggle_firewall")
     */
    public function toggleFirewall(Client $client)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $this->opnsense->setHost($client->getIpAddress());
        $this->opnsense->setPort($client->getPort());
        $this->opnsense->setKey($client->getApiKey());
        $this->opnsense->setSecret($client->getApiSecret());
        $prefix = "http://";
        if ($client->getHttps()){
            $prefix = "https://";
        }
        $this->opnsense->setPrefix($prefix);

        $uuid = $this->opnsense->firewallAlias()->getAliasUUID($client->getLocalNetworkAliasName());
//        dd ($uuid);
        $result = $this->opnsense->firewallAlias()->toggleItem($uuid->uuid);



        if($result->result == 'Disabled'){
            $status = 'On';
            $client->setFirewallOn('On');
        } else {
            $status = 'Off';
            $client->setFirewallOn('Off');
        }

        // Update database
        $this->entityManager->flush();

        // MUST reload Aliases for them to work.
        $this->opnsense->firewallAlias()->reconfigure();

        $this->addFlash('info', 'Firewall has been turned ' . $status . ' for ' . $client->getClientName()  );

        return $this->redirectToRoute('list_clients');

    }

    /**
     * @Route("/refreshFirmwareVersion/{clientID}", name="refresh_firmware_version")
     */
    public function refreshFirmwareVersion(string $clientID)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository(Client::class)->findOneBy(['id' => $clientID]);

        //Firmware
        $this->OStatusService->persistFirmwareData($client);

        return $this->redirectToRoute('list_clients');
    }

    /**
     * @Route("/refreshAliasStatus/{clientID}", name="refresh_alias_status")
     */
    public function refreshAliasStatus(string $clientID)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository(Client::class)->findOneBy(['id' => $clientID]);

        // Alias status
        $this->OStatusService->persistAliasStatus($client);

        return $this->redirectToRoute('list_clients');
    }
}
