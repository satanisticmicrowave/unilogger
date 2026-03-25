<?php

/**
 * @author satanisticmicrowave <satanisticmicrowave@ya.ru>
 * @copyright 2026 satanisticmirowave
 * @package App\Enum
 * @created 25.03.2026 17:09
 *
 * ~ unilogger
 */

declare(strict_types=1);


namespace App\Enum;

enum LogLevel: string
{
    case TRACE = 'trace';
    case DEBUG   = 'debug';
    case INFO    = 'info';
    case NOTICE  = 'notice';
    case WARNING = 'warning';
    case ERROR   = 'error';
    case CRITICAL = 'critical';
    case ALERT   = 'alert';
    case EMERGENCY = 'emergency';

    public function isError(): bool
    {
        return in_array($this, [self::ERROR, self::CRITICAL, self::ALERT, self::EMERGENCY], true);
    }

    public function getBootstrapColor(): string
    {
        return match ($this) {
            self::DEBUG, self::TRACE => 'debug',
            self::INFO, self::NOTICE => 'info',
            self::WARNING => 'warning',
            self::ERROR, self::CRITICAL, self::ALERT, self::EMERGENCY => 'critical',
        };
    }
}
