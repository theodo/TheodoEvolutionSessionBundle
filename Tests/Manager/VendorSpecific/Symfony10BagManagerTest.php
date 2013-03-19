<?php

namespace Theodo\Evolution\SessionIntegrationBundle\Tests\Manager\VendorSpecific;

use Theodo\Evolution\SessionIntegrationBundle\Manager\VendorSpecific\Symfony10BagManager;
use Theodo\Evolution\SessionIntegrationBundle\Manager\VendorSpecific\Symfony10BagConfiguration;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Symfony10BagManagerTest class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 */
class Symfony10BagManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $session = new Session(new MockArraySessionStorage());

        $configuration = new Symfony10BagConfiguration();
        $manager = new Symfony10BagManager($configuration);
        $manager->initialize($session);

        foreach ($configuration->getNamespaces() as $namespace) {
            if ($configuration->isArray($namespace)) {
                $this->assertInstanceOf('Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag', $session->getBag($namespace));
            } else {
                $this->assertInstanceOf('Theodo\Evolution\SessionIntegrationBundle\Attribute\ScalarBag', $session->getBag($namespace));
            }
        }
    }
}
