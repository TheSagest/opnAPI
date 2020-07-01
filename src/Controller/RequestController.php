<?php

namespace App\Controller;


use App\Entity\Client;
use App\Entity\Firmware;
use App\Service\Client\ClientQueryLogService ;
use App\Service\IPListService;
use App\Service\OpnSenseStatusService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RequestController extends AbstractController
{

    private $OpnSenseStatusService;
    private $em;
    private $queryLog;
    private $request;

    public function __construct(OpnSenseStatusService $OpnSenseStatusService,
                                EntityManagerInterface $em,
                                ClientQueryLogService $queryLog,
                                RequestStack $request
    )
    {

        $this->OpnSenseStatusService = $OpnSenseStatusService;
        $this->em = $em;
        $this->queryLog = $queryLog;
        $this->request = $request->getCurrentRequest();

    }

    /**
     * @Route("/api/{IPList}", name="api_request")
     * @return Response
     */
    public function api()
    {
        // Generate response
        $response = new Response();


        // Create the TEMP File
        $file = fopen('php://memory', 'rw+');

        fputs( $file , "; Created by Sage Link monitor API on " .date('d-m-Y-Hi'). "  \r");
        fputs( $file , 'hello' );

        rewind($file);
        $content = stream_get_contents($file);

        // Set headers
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', 'text/plain' );
        $response->headers->set('Content-Disposition', 'attachment; filename="file.txt";');
        $response->headers->set('Content-length',  strlen($content));

        $response->setcontent( $content );

        return $response;

    }

    /**
     * @Route("/firmware/{client}", name="download_firmware")
     * @param Client $client
     * @return Response
     */
    public function firmware (Client $client){
        $response = new Response();

        $this->OpnSenseStatusService->setFirmwareHeaders($client);
        $firmware = $this->OpnSenseStatusService->opnStatus->backup()->download();

        // Create the TEMP File
        $file = fopen('php://memory', 'rw+');

        fputs( $file , $firmware );

        rewind($file);
        $content = stream_get_contents($file);
// Set headers
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', 'text/plain' );
        $response->headers->set('Content-Disposition', 'attachment; filename=' .$client->getClientName() .  '.xml');
        $response->headers->set('Content-length',  strlen($content));

        $response->setcontent( $content );
        return $response;

    }

    /**
     * @Route("/saveFirmware/{client}", name="save_firmware")
     * @param Client $client
     * @return Response
     */
    public function saveFirmware (Client $client){

        $name = date('Y-m-d  H:i:s');

        $this->OpnSenseStatusService->setFirmwareHeaders($client);
        $firmware = $this->OpnSenseStatusService->opnStatus->backup()->download();

        // Create the TEMP File
        $file = fopen('php://memory', 'rw+');

        fputs( $file , $firmware );

        rewind($file);
        $content = stream_get_contents($file);

        $firmwareFile = new Firmware();
        $firmwareFile->setClient($client);
        $firmwareFile->setName($name);
        $firmwareFile->setContent($content);
        $this->em->persist($firmwareFile);
        $this->em->flush();

        return $this->redirectToRoute('list_clients');
    }

    /**
     * @Route("/downFirmware/{firmware}", name="down_firmware")
     * @param Firmware $firmware
     * @return Response
     */
    public function downloadFirmware (Firmware $firmware){
        $response = new Response();
        $em =  $this->getDoctrine()->getRepository(Firmware::class)->find($firmware);

        $content = $em->getContent();

// Set headers
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', 'text/plain' );
        $response->headers->set('Content-Disposition', 'attachment; filename='. $firmware->getClient()->getClientName(). ' '  .$firmware->getName() .  '.xml');
        $response->headers->set('Content-length',  strlen($content));

        $response->setcontent( $content );

        return $response;


    }

    /**
     * @Route("/deleteFirmware/{firmware}", name="delete_firmware")
     * @param Firmware $firmware
     * @return Response
     */
    public function deleteFirmware (Firmware $firmware){

        $em =  $this->getDoctrine()->getRepository(Firmware::class)->find( $firmware);

//        dd($em);

        $this->em->remove($em);
        $this->em->flush();

        return $this->redirectToRoute('edit_client',  ['client' => $firmware->getClient()->getId()]);

    }

}
