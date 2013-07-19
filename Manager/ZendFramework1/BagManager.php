<?php

namespace Theodo\Evolution\Bundle\SessionBundle\Manager\ZendFramework1;

use Theodo\Evolution\Bundle\SessionBundle\Manager\BagManager as BaseBagManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * The ZendFramework1BagManager handles registering zf1 session values into Symfony2 session.
 * This is being done mainly by creating and registering SessionBags.
 *
 * @author Jean Ashton <jeana@theodo.fr>
 * @author Marek Kalnik <marekk@theodo.fr>
 */
class BagManager extends BaseBagManager
{
    /**
     * Create bags for each namespaces (see constants of this class).
     */
    public function initialize(SessionInterface $session)
    {
        parent::initialize($session);

        $namespaces = $this->configuration->getNamespaces();
    }
}