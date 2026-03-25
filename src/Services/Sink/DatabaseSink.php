<?php

/**
 * @author satanisticmicrowave <satanisticmicrowave@ya.ru>
 * @copyright 2026 satanisticmirowave
 * @package App\Services\Sink
 * @created 25.03.2026 17:27
 *
 * ~ unilogger
 */

declare(strict_types=1);


namespace App\Services\Sink;

use App\Entity\Log;
use App\Interfaces\Sink\SinkInterface;
use Doctrine\ORM\EntityManagerInterface;

readonly class DatabaseSink implements SinkInterface
{
    public function __construct(private EntityManagerInterface $em)
    {}

    public function save(Log $log): void
    {
        $this->em->persist($log);
        $this->em->flush();
    }
}
