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

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('unilogger');

        $treeBuilder->getRootNode()
            ->children()
            ->arrayNode('sinks')
            ->useAttributeAsKey('name')
            ->arrayPrototype()
            ->children()
            ->booleanNode('enabled')->defaultFalse()->end()
            ->arrayNode('properties')
            ->variablePrototype()->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}

