<?php

namespace Theodo\Evolution\Bundle\SessionBundle\Manager\VendorSpecific;

use Theodo\Evolution\Bundle\SessionBundle\Manager\Symfony1\BagManager;
use Theodo\Evolution\Bundle\SessionBundle\Manager\BagManagerConfigurationInterface;

/**
 * @deprecated Renamed to Theodo\Evolution\Bundle\SessionBundle\Manager\Symfony1\BagManager
 */
class Symfony1xBagManager extends BagManager
{
    public function __construct(BagManagerConfigurationInterface $configuration)
    {
        parent::__construct($configuration);

        trigger_error('The class has been renamed to Theodo\Evolution\Bundle\SessionBundle\Manager\Symfony1\BagManager', E_USER_DEPRECATED);
    }
}
