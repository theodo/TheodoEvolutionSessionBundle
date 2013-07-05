<?php

namespace Theodo\Evolution\Bundle\SessionBundle\Tests\Manager\Symfony1;

use Theodo\Evolution\Bundle\SessionBundle\Manager\Symfony1\BagManager;
use Theodo\Evolution\Bundle\SessionBundle\Manager\Symfony1\BagConfiguration;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Symfony1\BagManagerTest class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 */
class BagManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $session = new Session(new MockArraySessionStorage());

        $configuration = new BagConfiguration();
        $manager = new BagManager($configuration);
        $manager->initialize($session);

        foreach ($configuration->getNamespaces() as $namespace) {
            if ($configuration->isArray($namespace)) {
                $this->assertInstanceOf('Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag', $session->getBag($namespace));
            } else {
                $this->assertInstanceOf('Theodo\Evolution\Bundle\SessionBundle\Attribute\ScalarBag', $session->getBag($namespace));
            }
        }
    }
}
