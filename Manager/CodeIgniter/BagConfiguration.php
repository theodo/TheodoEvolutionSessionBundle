<?php

namespace Theodo\Evolution\Bundle\SessionBundle\Manager\CodeIgniter;

use Theodo\Evolution\Bundle\SessionBundle\Manager\BagManagerConfigurationInterface;

/**
 * Class BagConfiguration
 *
 * @author Sébastien Tainon <sebastient@theodo.fr>
 */
class BagConfiguration implements BagManagerConfigurationInterface
{
    /**
     * @var array
     */
    private $namespaces = array('user');

    /**
     * {@inheritdoc}
     */
    public function getNamespaces()
    {
        return $this->namespaces;
    }

    /**
     * {@inheritdoc}
     */
    public function getNamespace($key)
    {
        return $this->namespaces[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function isArray($namespaceName)
    {
        if ($namespaceName == 'user') {
            return true;
        }

        return false;
    }
}