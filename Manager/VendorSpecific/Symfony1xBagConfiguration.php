<?php

namespace Theodo\Evolution\Bundle\SessionBundle\Manager\VendorSpecific;

use Theodo\Evolution\Bundle\SessionBundle\Manager\Symfony1\BagConfiguration;

/**
 * @deprecated Renamed to Theodo\Evolution\Bundle\SessionBundle\Manager\Symfony1\BagConfiguration
 */
class Symfony1xBagConfiguration extends BagConfiguration
{
    public function __construct()
    {
        trigger_error('The class has been renamed to Theodo\Evolution\Bundle\SessionBundle\Manager\Symfony1\BagConfiguration', E_USER_DEPRECATED);
    }
}
