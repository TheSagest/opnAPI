<?php

namespace App\EventSubscriber;

use App\Event\ModifyTextEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

class TestSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            ModifyTextEvent::class => 'onModifyTextEventX',
        ];
    }

    public function onModifyTextEventX(ModifyTextEvent $modifyTextEvent)
    {
        $text = $modifyTextEvent->getText();

        $text .= ' Appended text';

        $modifyTextEvent->setText($text);
    }
}