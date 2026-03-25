<?php

/**
 * @author satanisticmicrowave <satanisticmicrowave@ya.ru>
 * @copyright 2026 satanisticmirowave
 * @package App\Interfaces
 * @created 25.03.2026 17:43
 *
 * ~ unilogger
 */

declare(strict_types=1);


namespace App\Interfaces\Sink;

use App\Entity\Log;

interface SinkInterface
{
    public function save(Log $log): void;
}
