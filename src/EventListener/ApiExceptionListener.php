<?php

/**
 * @author satanisticmicrowave <satanisticmicrowave@ya.ru>
 * @copyright 2026 satanisticmirowave
 * @package App\EventListener
 * @created 25.03.2026 18:58
 *
 * ~ unilogger
 */

declare(strict_types=1);


namespace App\EventListener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ApiExceptionListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $request = $event->getRequest();

        if (!str_starts_with($request->getPathInfo(), '/api/')) {
            return;
        }

        $exception = $event->getThrowable();

        $statusCode = $exception instanceof HttpExceptionInterface
            ? $exception->getStatusCode()
            : Response::HTTP_INTERNAL_SERVER_ERROR;

        $responseData = [
            'status' => 'error',
            'message' => $exception->getMessage(),
            'code' => $statusCode,
        ];

        if ($request->server->get('APP_ENV') === 'dev') {
            $responseData['trace'] = $exception->getTraceAsString();
        }

        $response = new JsonResponse($responseData, $statusCode);
        $response->setEncodingOptions(JSON_PRETTY_PRINT);
        $event->setResponse($response);
    }
}
