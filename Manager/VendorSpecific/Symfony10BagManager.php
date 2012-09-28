<?php

namespace TheodoEvolution\HttpFoundationBundle\Manager\VendorSpecific;

use TheodoEvolution\HttpFoundationBundle\Manager\BagManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Attribute\NamespacedAttributeBag;
use TheodoEvolution\HttpFoundationBundle\Attribute\ScalarBag;

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

        // @todo Ask Benajmin why this has to be done
        $session->getBag($namespaces['last_request_namespace'])->set(time());
    }
}
