<?php

namespace Theodo\Evolution\Bundle\SessionIntegrationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * SessionPass class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 */
class SessionPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        // Make the session service use Evolution native storage class.
        $container->getDefinition('session.storage.native')
            ->setClass($container->getParameter('evolution.session.storage.native.class'));

        $container->getDefinition('session.storage.mock_file')
            ->setClass($container->getParameter('evolution.session.storage.mock_file.class'));
    }

}
