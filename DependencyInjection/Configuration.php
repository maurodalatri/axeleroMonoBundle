<?php

namespace Axelero\MonoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('axelero_mono');

        $rootNode
            ->children()
                ->scalarNode('api_reseller_token')
                    ->isRequired()
                ->end()
                ->scalarNode('reseller_class')
                    ->cannotBeEmpty()
                    ->defaultValue("Axelero\MonoBundle\Mono\Reseller")
                ->end()
                ->scalarNode('site_class')
                    ->cannotBeEmpty()
                    ->defaultValue("Axelero\MonoBundle\Mono\Site")
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
