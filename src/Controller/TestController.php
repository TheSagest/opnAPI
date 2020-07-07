<?php

namespace App\Controller;


use App\Event\DownloadClientListEvent;
use App\Event\ModifyTextEvent;
use App\Module\Block\Service\BlockService;
use App\Module\Main\Block\Page\MainPage;
use App\Repository\ClientRepository;
use App\Service\EndpointUpService;
use Psr\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    private $endPoint;
    private $block;
    private $clientRepository;
    private $eventDispatcher;

    public function __construct(
        EndpointUpService $endPoint,
        BlockService $block,
        ClientRepository $clientRepository,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->endPoint = $endPoint;
        $this->block = $block;
        $this->clientRepository = $clientRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @Route("/test")
     * * @return Response
     */
    public function test(){

        $text = 'Cool Shit';
        $event = new ModifyTextEvent();
        $event->setText($text);

        // Fire / Dispatch the event
        $this->eventDispatcher->dispatch($event);


        $downloadClientListEvent = new DownloadClientListEvent();
        $downloadClientListEvent->setClient('Phil Object');
        $downloadClientListEvent->setList('List');
        $downloadClientListEvent->setDateTime(new \DateTime());
        $this->eventDispatcher->dispatch($downloadClientListEvent);


        //$rendered = $this->block->renderBlock(\App\Module\Test\Block\Test::class) ;

        return new Response($event->getText());
//        return  $response;
    }

    /**
     * @Route("/up/{clientID}", name="up")
     * @param string $clientID
     * @return Response
     */
    public function up(string $clientID = "" ){
        $response = new Response();
        if (!$clientID){
            $response->setContent(false);
        } else {
            $response->setContent( $this->endPoint->isUp ($clientID));
        }

        return $response;
    }



    /**
     * @Route("/main")
     * * @return Response
     */
    public function main(){


        $renderedResponse = $this->block->renderBlock(MainPage::class, [

        ]);
        return new Response($renderedResponse);

    }

}