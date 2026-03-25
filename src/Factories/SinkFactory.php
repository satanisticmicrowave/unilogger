<?php

/**
 * @author satanisticmicrowave <satanisticmicrowave@ya.ru>
 * @copyright 2026 satanisticmirowave
 * @package App\Factories
 * @created 25.03.2026 17:50
 *
 * ~ unilogger
 */

declare(strict_types=1);


namespace App\Factories;

use App\Exceptions\Sink\SinkNotFoundException;
use App\Interfaces\Sink\ConfigurableSinkInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

readonly class SinkFactory
{
    public function __construct(
        private ContainerInterface $container,
        private array              $sinkConfig
    ) {}

    public function createSinks(): array
    {
        $sinks = [];

        foreach ($this->sinkConfig as $name => $config) {

            if (!($config['enabled'] ?? false)) {
                continue;
            }

            $serviceId = 'unilogger.sink.' . $name;

            if (!$this->container->has($serviceId)) {
                throw new SinkNotFoundException("Sink '{$name}' does not exist.");
            }

            $sink = $this->container->get($serviceId);

            if ($sink instanceof ConfigurableSinkInterface) {
                $sink->configure($config['properties'] ?? []);
            }

            $sinks[] = $sink;
        }

        return $sinks;
    }

}
