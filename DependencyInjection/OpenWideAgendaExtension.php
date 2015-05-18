<?php

namespace OpenWide\AgendaBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class OpenWideAgendaExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('services.yml');
        $loader->load('default_settings.yml');

        $container->setParameter('open_wide_agenda.root.location_id', $config['root']['location_id']);

        $container->setParameter('open_wide_agenda.template.index', $config['template']['index']);
        $container->setParameter('open_wide_agenda.template.indexmini', $config['template']['indexmini']);

        $container->setParameter('open_wide_agenda.controller.agenda.view.class', $config['controller']['agendaview']);
        $container->setParameter('open_wide_agenda.controller.event.view.class', $config['controller']['eventview']);

//        $container->setParameter('open_wide_agenda.fetch_by_legacy', $config['helpers']['agenda_fetch_by_legacy']);
    }
}