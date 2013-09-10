<?php

namespace Theodo\Evolution\Bundle\SessionBundle\Manager\CodeIgniter;

use Theodo\Evolution\Bundle\SessionBundle\Manager\BagManagerConfigurationInterface;

/**
 * Class BagConfiguration
 * @author Sébastien Tainon <sebastient@theodo.fr>
 */
class BagConfiguration implements BagManagerConfigurationInterface
{
    private $namespaces = array('user');

    /**
     * Gets a list of all session namespaces used by application.
     * A session namespace is a key in $_SESSION array.
     *
     * @return array
     */
    public function getNamespaces()
    {
        return $this->namespaces;
    }

    /**
     * Gets a session namespace from a namespace key.
     * A session namespace is a key in $_SESSION array.
     *
     * @return array
     */
    public function getNamespace($key)
    {
        return $this->namespaces[$key];
    }

    /**
     * Returns if the namespace is an array of namespaces.
     * Use for nested session values.
     *
     * @param string $namespaceName
     *
     * @return boolean
     */
    public function isArray($namespaceName)
    {
        if ($namespaceName == 'user') {
            return true;
        }

        return false;
    }

}