<?php

namespace Theodo\Evolution\HttpFoundationBundle\Manager;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * A BagManager handles registering legacy session values in Symfony2 session.
 * This is being done mainly by creating and registering SessionBags.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 */
interface BagManagerInterface
{
    /**
     * Register bags in the session.
     *
     * @param \Symfony\Component\HttpFoundation\Session\SessionInterface $session
     */
    public function initialize(SessionInterface $session);
}
