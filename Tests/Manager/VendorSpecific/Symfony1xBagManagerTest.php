<?php

namespace Theodo\Evolution\Bundle\SessionIntegrationBundle\Tests\Manager\VendorSpecific;

use Theodo\Evolution\Bundle\SessionIntegrationBundle\Manager\VendorSpecific\Symfony1xBagManager;
use Theodo\Evolution\Bundle\SessionIntegrationBundle\Manager\VendorSpecific\Symfony1xBagConfiguration;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;

/**
 * Symfony1xBagManagerTest class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 */
class Symfony1xBagManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testInitialize()
    {
        $session = new Session(new MockArraySessionStorage());

        $configuration = new Symfony1xBagConfiguration();
        $manager = new Symfony1xBagManager($configuration);
        $manager->initialize($session);

        foreach ($configuration->getNamespaces() as $namespace) {
            if ($configuration->isArray($namespace)) {
                $this->assertInstanceOf('Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag', $session->getBag($namespace));
            } else {
                $this->assertInstanceOf('Theodo\Evolution\Bundle\SessionIntegrationBundle\Attribute\ScalarBag', $session->getBag($namespace));
            }
        }
    }
}
