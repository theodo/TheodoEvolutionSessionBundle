<?php
namespace Theodo\Evolution\Bundle\SessionBundle\Manager;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Theodo\Evolution\Bundle\SessionBundle\Manager\BagManager;

class BagManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $configuration = $this->getMock('Theodo\Evolution\Bundle\SessionBundle\Manager\BagManagerConfigurationInterface');
        $configuration->expects($this->once())
            ->method('getNamespaces')
            ->will($this->returnValue(array('array', 'scalar')))
        ;

        $configuration->expects($this->exactly(2))
            ->method('isArray')
            ->with($this->anything())
            ->will($this->onConsecutiveCalls(true, false))
        ;

        $session = new Session(new MockArraySessionStorage());

        $manager = new BagManager($configuration);
        $manager->initialize($session);

        $this->assertInstanceOf('Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag', $session->getBag('array'));
        $this->assertInstanceOf('Theodo\Evolution\Bundle\SessionBundle\Attribute\ScalarBag', $session->getBag('scalar'));
    }
}
