<?php

/**
 * @author satanisticmicrowave <satanisticmicrowave@ya.ru>
 * @copyright 2026 satanisticmirowave
 * @package App\Services
 * @created 25.03.2026 17:29
 *
 * ~ unilogger
 */

declare(strict_types=1);


namespace App\Services;

use App\Factories\SinkFactory;

readonly class LoggerService
{

    public function __construct(private SinkFactory $sinkFactory)
    {}

    private function getSinks(): array
    {
        static $sinks = null;
        return $sinks ??= $this->sinkFactory->createSinks();
    }

}
