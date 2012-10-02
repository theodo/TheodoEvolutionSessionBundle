<?php

namespace Theodo\Evolution\HttpFoundationBundle\Storage;

use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage as BaseSessionStorage;

/**
 * Class MockFileSessionStorage description.
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 */
class MockFileSessionStorage extends BaseSessionStorage
{
    protected function loadSession()
    {
        $bags = array_merge($this->bags, array($this->metadataBag));

        foreach ($bags as $bag) {
            $key = $bag->getStorageKey();
            $this->data[$key] = isset($this->data[$key]) ? (array) $this->data[$key] : array();
            $bag->initialize($this->data[$key]);
        }

        $this->started = true;
        $this->closed = false;
    }
}
