<?php

namespace TheodoEvolution\HttpFoundationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use TheodoEvolution\HttpFoundationBundle\DependencyInjection\Compiler\SessionPass;

class TheodoEvolutionHttpFoundationBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SessionPass());
    }
}
