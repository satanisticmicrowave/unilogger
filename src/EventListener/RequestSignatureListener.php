<?php

/**
 * @author satanisticmicrowave <satanisticmicrowave@ya.ru>
 * @copyright 2026 satanisticmirowave
 * @package App\EventListener
 * @created 25.03.2026 18:47
 *
 * ~ unilogger
 */

declare(strict_types=1);


namespace App\EventListener;

use App\Security\RequestSignatureValidator;
use Symfony\Component\HttpKernel\Event\RequestEvent;

readonly class RequestSignatureListener
{
    public function __construct(
        private RequestSignatureValidator $validator
    ) {}

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $request = $event->getRequest();

        if (!str_starts_with($request->getPathInfo(), '/api/')) {
            return;
        }

        $this->validator->validate($request);
    }
}
