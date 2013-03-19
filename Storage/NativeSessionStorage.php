<?php

namespace Theodo\Evolution\SessionIntegrationBundle\Storage;

use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage as BaseSessionStorage;

/**
 * NativeSessionStorage class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 */
class NativeSessionStorage extends BaseSessionStorage
{
    /**
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
