<?php

namespace Neutron\Widget\ContactBlockBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class NeutronContactBlockExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        
        foreach (array('widget_contact_block', 'contact_block') as $basename) {
            $loader->load(sprintf('%s.xml', $basename));
        }
        
        if (false === $config['enable']){
            $container->getDefinition('neutron_contact_block.widget')
                ->clearTag('neutron.widget');
        }
        
        $this->loadGeneralConfigurations($config, $container);
        $this->loadWidgetContactBlockConfigurations($config['widget'], $container);
        $this->loadBlockConfigurations($config['block'], $container);
    }
    
    protected function loadGeneralConfigurations(array $config, ContainerBuilder $container)
    {
 
        $container->setParameter('neutron_contact_block.enable', $config['enable']);
        $container->setParameter('neutron_contact_block.translation_domain', $config['translation_domain']);
      
    }
    
    protected function loadWidgetContactBlockConfigurations(array $config, ContainerBuilder $container)
    {
 
        $container->setParameter('neutron_contact_block.widget_contact_block_class', $config['class']);
        $container->setParameter('neutron_contact_block.contact_block_reference_class', $config['reference_class']);
        $container->setAlias('neutron_contact_block.widget_contact_block_manager', $config['manager']);
        $container->setAlias('neutron_contact_block.controller.backend.widget_contact_block', $config['controller_backend']);
        $container->setAlias('neutron_contact_block.controller.frontend.widget_contact_block', $config['controller_frontend']);

        $container->setAlias('neutron_contact_block.form.backend.handler.widget_contact_block', $config['form_backend']['handler']);
        $container->setParameter('neutron_contact_block.form.backend.type.widget_contact_block', $config['form_backend']['type']);
        $container->setParameter('neutron_contact_block.form.backend.name.widget_contact_block', $config['form_backend']['name']);
        
        $container->setParameter('neutron_contact_block.datagrid.widget_contact_block_management', $config['datagrid_management']);
        $container->setParameter('neutron_contact_block.datagrid.contact_block_multi_select_sortable', $config['datagrid_multi_select_sortable']);
       
        $container->setParameter('neutron_contact_block.widget_contact_block_templates', $config['templates']);
    }
    
    protected function loadBlockConfigurations(array $config, ContainerBuilder $container)
    {
 
        $container->setParameter('neutron_contact_block.contact_block_class', $config['class']);
        $container->setAlias('neutron_contact_block.contact_block_manager', $config['manager']);
        $container->setAlias('neutron_contact_block.controller.backend.contact_block', $config['controller_backend']);

        $container->setAlias('neutron_contact_block.form.backend.handler.contact_block', $config['form_backend']['handler']);
        $container->setParameter('neutron_contact_block.form.backend.type.contact_block', $config['form_backend']['type']);
        $container->setParameter('neutron_contact_block.form.backend.name.contact_block', $config['form_backend']['name']);
        
        $container->setParameter('neutron_contact_block.datagrid.contact_block_management', $config['datagrid_management']);
    }
}
