<?php

namespace Theodo\Evolution\SessionIntegrationBundle\Manager\VendorSpecific;

use Theodo\Evolution\SessionIntegrationBundle\Manager\BagManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * EvolutionAttributeBag class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @author Marek Kalnik <marekk@theodo.fr>
 */
class Symfony10BagManager extends BagManager
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
         * update it as if it was Symfony1 who acessed it
         */
        $session->getBag($namespaces['last_request_namespace'])->set(time());
    }
}
