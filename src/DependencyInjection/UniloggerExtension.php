<?php

/**
 * @author: satanisticmicrowave <satanisticmicrowave@ya.ru>
 * @copyright 2026 satanisticmirowave
 * @created 25.03.2026 17:59
 *
 *
 * ~ unilogger
 */

declare(strict_types=1);

namespace App\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class UniloggerExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('unilogger.sinks', $config['sinks'] ?? []);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
    }
}
