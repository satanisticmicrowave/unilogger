<?php

/**
 * @author satanisticmicrowave <satanisticmicrowave@ya.ru>
 * @copyright 2026 satanisticmirowave
 * @package App\Interfaces\Sink
 * @created 25.03.2026 17:44
 *
 * ~ unilogger
 */

declare(strict_types=1);


namespace App\Interfaces\Sink;

use App\Exceptions\Sink\SinkConfigureException;

interface ConfigurableSinkInterface
{
    /**
     * Configure sink parameter
     *
     * @param array<string, mixed> $config
     * @return void
     * @throws SinkConfigureException
     */
    public function configure(array $config): void;
}
