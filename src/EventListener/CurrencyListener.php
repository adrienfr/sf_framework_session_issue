<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class CurrencyListener
{
    /** @var RequestStack */
    private $requestStack;

    public function __construct(
        RequestStack $requestStack
    ) {
        $this->requestStack = $requestStack;
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $session = $this->requestStack->getSession();

        if (!$event->isMainRequest()) {
            return;
        }
        if (!$session->has('currency')) {
            $this->setCurrency($session);
        }
    }

    private function setCurrency(Session $session): bool
    {
        $session->set('currency', 'EUR');

        return true;
    }
}
