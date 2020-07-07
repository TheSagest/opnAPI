<?php

namespace App\EventSubscriber;

use App\Event\DownloadClientListEvent;
use App\Event\ModifyTextEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class LogClientListDownloadSubscriber implements EventSubscriberInterface
{
    protected $logger;

    public function __construct(
        LoggerInterface $logger
    )
    {
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            DownloadClientListEvent::class => 'onDownloadClientListEvent',
        ];
    }

    public function onDownloadClientListEvent(DownloadClientListEvent $downloadClientListEvent)
    {
        $this->logger->info(sprintf(
            'Client %s downloaded list %s at %s',
            $downloadClientListEvent->getClient(),
            $downloadClientListEvent->getList(),
            $downloadClientListEvent->getDateTime()->format('Y-m-d H:i:s')
        ));
    }
}