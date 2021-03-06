<?php

namespace App\EventListener;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

/**
 * Class AuthenticationSubscriber
 */
class AuthenticationSubscriber implements EventSubscriberInterface
{
    private $logger;
    private $request;

    public function __construct(LoggerInterface $logger, RequestStack $request)
    {
        $this->logger = $logger;
        $this->request = $request;
    }

    /**
     * onAuthenticationFailure
     */
    public function onAuthenticationFailure(AuthenticationEvent $authenticationEvent)
    {
        if ($authenticationEvent->getAuthenticationToken()->getUsername() === 'anon.')
        {
            return;
        }

        $ipAddress = $this->request->getCurrentRequest()->getClientIp();
//        dd($authenticationEvent->getAuthenticationToken(),$ipAddress);

        $this->logger->error('Authentication failed for IP: ' . $ipAddress);
    }

    public static function getSubscribedEvents()
    {
        return [
            //AuthenticationEvent::class => 'onAuthenticationFailure',
            AuthenticationEvents::AUTHENTICATION_FAILURE => 'onAuthenticationFailure'
        ];
    }
}