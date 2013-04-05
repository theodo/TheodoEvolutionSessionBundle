<?php

namespace Theodo\Evolution\Bundle\SessionBundle\Manager\VendorSpecific;

use Theodo\Evolution\Bundle\SessionBundle\Manager\BagManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * EvolutionAttributeBag class.
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 * @author Marek Kalnik <marekk@theodo.fr>
 */
class Symfony1xBagManager extends BagManager
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
