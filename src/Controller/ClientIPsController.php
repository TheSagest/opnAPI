<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\ClientApiUrl;
use App\Form\ClientUrlApiType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



class ClientIPsController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/listClientIPs/{client}", name="list_client_ips")
     */
    public function listClientIPs(Client $client  , Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');



        if ( strcmp( $client->getClientName(), '_globalBlock')){
                $global = $this->getDoctrine()->getRepository(Client::class)->findOneBy(['clientName' => '_globalBlock']);
//            dd($global);
        } else {
                $global = $this->getDoctrine()->getRepository(Client::class)->findOneBy(['clientName' => 'zzzx']);
//            dd($global);
        }



        return $this->render('ips/listIPs.html.twig', [
            'client' => $client,
            'thisHost' => $request->getSchemeAndHttpHost(),
            'global' => $global
        ]);
    }

    /**
     * @Route("/createClientIP/{client}", name="create_client_ip")
     */
    public function createClientIP(Request $request, Client $client)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $clientIpList = new ClientApiUrl();
        $clientIpList->setClient($client);

        $form = $this->createForm(ClientUrlApiType::class, $clientIpList);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Save
            $em = $this->getDoctrine()->getManager();
            $em->persist($clientIpList);
            $em->flush();

            return $this->redirectToRoute('list_client_ips',
                [
                    'client' => $client->getId()
                ]);
        }
        return $this->render('ips/create.html.twig', [
            'form' => $form->createView(),
            'client' => $client,
        ]);


    }

    /**
     * @Route("/deleteClientIP/{clientApiUrl}", name="delete_client_ip")
     */
    public function deleteClientIP(ClientApiUrl $clientApiUrl )
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();

        $em->remove($clientApiUrl);
        $em->flush();

        $this->addFlash('info', 'deleted '.$clientApiUrl->getURLName() . ' from ' . $clientApiUrl->getClient()->getClientName() );

        return $this->redirectToRoute('list_client_ips', ['client' => $clientApiUrl->getClient()->getId()]);

    }

    /**
     * @Route("/editClientIP/{clientApiUrl}", name="edit_client_ip")
     */
    public function editClient(ClientApiUrl $clientApiUrl, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ClientUrlApiType::class, $clientApiUrl);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Save
            $IPList = $form->getData();
            $em->flush();

            return $this->redirectToRoute('list_client_ips', ['client' => $clientApiUrl->getClient()->getId()]);
            }

        return $this->render('ips/edit.html.twig', [
            'form' => $form->createView(),
            'clientApiUrl' => $clientApiUrl ,
        ]);
    }

}
