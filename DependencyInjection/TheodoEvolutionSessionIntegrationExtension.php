<?php

namespace Theodo\Evolution\Bundle\SessionIntegrationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;


class TheodoEvolutionSessionIntegrationExtension extends Extension
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
        $this->loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));
        $this->loader->load('session.yml');
    }
}