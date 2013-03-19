<?php

namespace Theodo\Evolution\SessionIntegrationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;


class SessionIntegrationExtension extends Extension
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

        $this->loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));

        // session configuration can be unset.
        if (isset($config)) {
            $this->loadSession($config, $container);
        }
    }

    /**
     * Load session service definition file.
     *
     * @param $config
     * @param $container
     */
    public function loadSession(array $config, ContainerBuilder $container)
    {
        $this->loader->load('session.yml');

        $bagManagerClass = $container->getParameter('evolution.session.symfony'.$this->getVersion($container).'_bag_manager.class');
        $container->getDefinition('evolution.session.bag_manager')
            ->setClass($bagManagerClass);

        // Prepare options by application for the session service.
        foreach ($config as $application => $definition) {
            $options = array();
            foreach (array('name') as $key) {
                if (isset($definition[$key])) {
                    $options[$key] = $definition[$key];
                }
            }

            $container->setParameter('evolution.session.'.$application.'.options', $options);
            $container->setParameter('evolution.session.'.$application.'.save_path', $definition['save_path']);
        }

        // Boot Symfony.
        $container->get('evolution.legacy.connector')->boot($container);
    }

    /**
     * @param  \Symfony\Component\DependencyInjection\ContainerBuilder $container
     * @return mixed
     */
    private function getVersion(ContainerBuilder $container)
    {
        return $container->getParameter('evolution.legacy.version');
    }
}
