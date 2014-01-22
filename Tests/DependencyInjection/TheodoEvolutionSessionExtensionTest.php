<?php

namespace Theodo\Evolution\Bundle\SessionBundle\Tests\DependencyInjection;

use Symfony\Component\Yaml\Parser;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Theodo\Evolution\Bundle\SessionBundle\DependencyInjection\TheodoEvolutionSessionExtension;

class TheodoEvolutionSessionExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getConfiguration
     */
    public function testConfiguration($config)
    {
        $parser = new Parser();
        $config = $parser->parse($config);

        $builder = new ContainerBuilder();
        $extension = new TheodoEvolutionSessionExtension();
        $extension->load(array($config), $builder);
    }

    public function getConfiguration()
    {
        return array(
            array(<<<YML
bag_manager:
    class: TestClass
    configuration_class: TestConfigurationClass
YML
            ),
            array(<<<YML
bag_manager_service: foo
bag_configuration_service: bar
YML
            )
        );
    }

    /**
     * @dataProvider getInvalidConfiguration
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidConfiguration($config)
    {
        $parser = new Parser();
        $config = $parser->parse($config);

        $builder = new ContainerBuilder();
        $extension = new TheodoEvolutionSessionExtension();
        $extension->load(array($config), $builder);
    }

    public function getInvalidConfiguration()
    {
        return array(
            array(""),
            array(<<<YML
bag_manager_service:
bag_configuration_service:
bag_manager:
    class:
    configuration_class:

YML
            )
        );
    }
}
