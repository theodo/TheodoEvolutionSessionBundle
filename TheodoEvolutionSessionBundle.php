<?php

namespace Theodo\Evolution\Bundle\SessionBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Theodo\Evolution\Bundle\SessionBundle\DependencyInjection\Compiler\SessionPass;

class TheodoEvolutionSessionBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SessionPass());
    }
}
