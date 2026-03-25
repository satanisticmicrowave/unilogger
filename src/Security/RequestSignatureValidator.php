<?php

/**
 * @author satanisticmicrowave <satanisticmicrowave@ya.ru>
 * @copyright 2026 satanisticmirowave
 * @package App\Security
 * @created 25.03.2026 18:43
 *
 * ~ unilogger
 */

declare(strict_types=1);


namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class RequestSignatureValidator
{

    private const int ALLOWED_TIME_DIFF = 10;

    public function __construct(private readonly string $secret) {}

    public function validate(Request $request): void
    {
        $timestampHeader = $request->headers->get('UNILOGGER_TIMESTAMP');
        $signatureHeader = $request->headers->get('UNILOGGER_REQUEST_SIGNATURE');

        if (!$timestampHeader || !$signatureHeader) {
            throw new BadRequestHttpException(
                'Missing UNILOGGER_TIMESTAMP or UNILOGGER_REQUEST_SIGNATURE header');
        }

        $timestamp = (int) $timestampHeader;

        if (abs(time() - $timestamp) > self::ALLOWED_TIME_DIFF) {
            throw new BadRequestHttpException('Timestamp is too old or too far in the future');
        }

        $contentLength = $request->headers->get('Content-Length', '0');
        $body = $request->getContent();
        $contentSha256 = $request->headers->get('UNILOGGER-CONTENT-SHA256') ?? hash('sha256', $body);

        $payload = implode("\n", [
            $timestamp,
            $contentLength,
            $contentSha256,
            $request->getMethod(),
            $request->getPathInfo()
        ]);

        $expectedSignature = base64_encode(hash_hmac('sha256', $payload, $this->secret, true));

        if (!hash_equals($expectedSignature, $signatureHeader)) {
            throw new BadRequestHttpException('Invalid UNILOGGER-REQUEST-SIGNATURE');
        }
    }

}
