<?php

namespace Theodo\Evolution\Bundle\SessionBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class TheodoEvolutionSessionExtension extends Extension
{
    /**
     * @var \Symfony\Component\DependencyInjection\Loader\YamlFileLoader
     */
    private $loader;

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $this->loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));
        $this->loader->load('session.xml');

        $this->addBagManager($container, $config);
    }

    /**
     * @param ContainerBuilder $container
     * @param $config
     * @throws \InvalidArgumentException
     */
    private function addBagManager(ContainerBuilder $container, $config)
    {
        $managerAlias = 'theodo_evolution.session.bag_manager';
        if (isset($config['bag_manager_service']) && isset($config['bag_configuration_service'])) {
            $managerId = $config['bag_manager_service'];
            if ($managerAlias !== $managerId) {
                $container->setAlias($managerAlias, $managerId);
            }
            $container->setAlias('theodo_evolution.session.bag_manager_configuration', $config['bag_configuration_service']);
        } else {
            if (!isset($config['bag_manager']['class']) || ! isset($config['bag_manager']['configuration_class'])) {
                throw new \InvalidArgumentException('You must provide the bag manager and the bag configuration services id.');
            }

            // BC
            $container->setParameter(
                'theodo_evolution.session.bag_manager.class',
                $config['bag_manager']['class']
            );
            $container->setParameter(
                'theodo_evolution.session.bag_manager_configuration.class',
                $config['bag_manager']['configuration_class']
            );
            $container->setAlias($managerAlias, 'theodo_evolution.session.bag_manager_default');
        }
    }
}
