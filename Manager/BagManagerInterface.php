<?php

namespace TheodoEvolution\HttpFoundationBundle\Manager;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * BagManagerInterface class.
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
