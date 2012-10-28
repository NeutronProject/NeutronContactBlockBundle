<?php

namespace Neutron\Widget\ContactBlockBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('neutron_contact_block');

        $this->addGeneralConfigurations($rootNode);
        $this->addWidgetContactBlockConfigurations($rootNode);
        $this->addContactBlockConfigurations($rootNode);
        
        return $treeBuilder;
    }
    
    private function addGeneralConfigurations(ArrayNodeDefinition $node)
    {
        $node
            ->addDefaultsIfNotSet()
            ->children()
                ->booleanNode('enable')->defaultFalse()->end()
                ->scalarNode('translation_domain')->defaultValue('NeutronContactBlockBundle')->end()
            ->end()
        ;
    }
    
    private function addWidgetContactBlockConfigurations(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                 ->arrayNode('widget')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('reference_class')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('manager')->defaultValue('neutron_contact_block.doctrine.widget_contact_block_manager.default')->end()
                            ->scalarNode('controller_backend')->defaultValue('neutron_contact_block.controller.backend.widget_contact_block.default')->end()
                            ->scalarNode('controller_frontend')->defaultValue('neutron_contact_block.controller.frontend.widget_contact_block.default')->end()
                            ->scalarNode('datagrid_multi_select_sortable')->defaultValue('neutron_contact_block_multi_select_sortable')->end()
                            ->scalarNode('datagrid__management')->defaultValue('neutron_widget_contact_block_management')->end()  
                            ->arrayNode('form_backend')
                            ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('type')->defaultValue('neutron_backend_widget_contact_block')->end()
                                    ->scalarNode('handler')->defaultValue('neutron_contact_block.form.backend.handler.widget_contact_block.default')->end()
                                    ->scalarNode('name')->defaultValue('neutron_backend_widget_contact_block')->end()
                                ->end()
                            ->end()
                            ->arrayNode('templates')
                                ->useAttributeAsKey('name')
                                    ->prototype('scalar')
                                ->end() 
                                ->cannotBeOverwritten()
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
    
      private function addContactBlockConfigurations(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                 ->arrayNode('block')
                    ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('manager')->defaultValue('neutron_contact_block.doctrine.contact_block_manager.default')->end()
                            ->scalarNode('controller_backend')->defaultValue('neutron_contact_block.controller.backend.contact_block.default')->end()
                            ->scalarNode('datagrid_management')->defaultValue('neutron_contact_block_management')->end()
                            ->arrayNode('form_backend')
                            ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('type')->defaultValue('neutron_backend_contact_block')->end()
                                    ->scalarNode('handler')->defaultValue('neutron_contact_block.form.backend.handler.contact_block.default')->end()
                                    ->scalarNode('name')->defaultValue('neutron_backend_contact_block')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

}
