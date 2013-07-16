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
    protected $locale;

    /**
     * Create bags for each namespaces (see constants of this class).
     */
    public function initialize(SessionInterface $session)
    {
        parent::initialize($session);

        $namespaces = $this->configuration->getNamespaces();

        /* Symfony1 keeps the last request value here
         * update it as if it was Symfony1 who accessed it
         */
        $session->getBag($namespaces['last_request_namespace'])->set(time());
    }
}
