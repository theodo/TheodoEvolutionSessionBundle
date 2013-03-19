<?php

namespace Theodo\Evolution\Bundle\SessionIntegrationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Theodo\Evolution\Bundle\SessionIntegrationBundle\DependencyInjection\Compiler\SessionPass;

class TheodoEvolutionSessionIntegrationBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SessionPass());
    }
}
