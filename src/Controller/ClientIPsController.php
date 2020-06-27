<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\IPList;
use App\Form\IPsType;
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

        $global = $this->getDoctrine()->getRepository(Client::class)->findBy(['clientName' => '_globalBlock']);

        return $this->render('ips/listIPs.html.twig', [
            'client' => $client,
            'global' => $global[0],
        ]);
    }

    /**
     * @Route("/createClientIP/{client}", name="create_client_ip")
     */
    public function createClientIP(Request $request, Client $client)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $ipList = new IPList();

        $form = $this->createForm(IPsType::class, $ipList);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Save
            $ipList->setClient($client);
            $em = $this->getDoctrine()->getManager();
            $em->persist($ipList);
            $em->flush();

            return $this->redirectToRoute('list_client_ips', ['client' => $client->getId()]);
        }

        return $this->render('ips/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/deleteClientIP/{IPList}", name="delete_client_ip")
     */
    public function deleteClientIP(IPList $IPList )
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();

        $em->remove($IPList);
        $em->flush();

        $this->addFlash('info', 'deleted '.$IPList->getIPlist() . ' from ' . $IPList->getClient()->getClientName() );

        return $this->redirectToRoute('list_client_ips', ['client' => $IPList->getClient()->getId()]);

    }

    /**
     * @Route("/editClientIP/{IPList}", name="edit_client_ip")
     */
    public function editClient(IPList $IPList, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(IPsType::class, $IPList);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Save
            $IPList = $form->getData();
            $em->flush();

            return $this->redirectToRoute('list_client_ips', ['client' => $IPList->getClient()->getId()]);
            }

        return $this->render('ips/edit.html.twig', [
            'form' => $form->createView(),
            'IPList' => $IPList ,
        ]);
    }

}
