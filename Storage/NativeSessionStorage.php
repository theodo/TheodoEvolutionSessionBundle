<?php

namespace Theodo\Evolution\Bundle\SessionBundle\Storage;

use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage as BaseSessionStorage;

/**
 *
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 */
class NativeSessionStorage extends BaseSessionStorage
{
    /**
     * Casts every session item to an array. So it can resolve into Symfony bags without
     * conflicts.
     *
     * {@inheritdoc}
     */
    protected function loadSession(array &$session = null)
    {
        if (null === $session) {
            $session = &$_SESSION;
        }

        $bags = array_merge($this->bags, array($this->metadataBag));

        foreach ($bags as $bag) {
            $key = $bag->getStorageKey();
            $session[$key] = isset($session[$key]) ? (array) $session[$key] : array();
            $bag->initialize($session[$key]);
        }

        $this->started = true;
        $this->closed = false;
    }
}
