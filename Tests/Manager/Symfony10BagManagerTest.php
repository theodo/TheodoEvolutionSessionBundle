<?php

namespace TheodoEvolution\HttpFoundationBundle\Tests\Manager;

use TheodoEvolution\HttpFoundationBundle\Manager\Symfony10BagManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use TheodoEvolution\HttpFoundationBundle\Manager\Symfony10BagNamespaces;

/**
 * Symfony10BagManagerTest class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 */
class Symfony10BagManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');
        $container->expects($this->once())
            ->method('getParameter')
            ->with('kernel.default_locale')
            ->will($this->returnValue('fr'));

        $session = new Session(new MockArraySessionStorage());

        $manager = new Symfony10BagManager($container);
        $manager->initialize($session);

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag', $session->getBag(Symfony10BagNamespaces::ATTRIBUTE_NAMESPACE));
        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag', $session->getBag(Symfony10BagNamespaces::CREDENTIAL_NAMESPACE));
        $this->assertInstanceOf('TheodoEvolution\HttpFoundationBundle\Attribute\ScalarBag', $session->getBag(Symfony10BagNamespaces::AUTH_NAMESPACE));
        $this->assertInstanceOf('TheodoEvolution\HttpFoundationBundle\Attribute\ScalarBag', $session->getBag(Symfony10BagNamespaces::LAST_REQUEST_NAMESPACE));
        $this->assertInstanceOf('TheodoEvolution\HttpFoundationBundle\Attribute\ScalarBag', $session->getBag(Symfony10BagNamespaces::CULTURE_NAMESPACE));
    }
}
