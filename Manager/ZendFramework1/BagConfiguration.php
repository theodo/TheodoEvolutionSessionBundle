<?php

namespace Theodo\Evolution\Bundle\SessionBundle\Manager\ZendFramework1;

use Theodo\Evolution\Bundle\SessionBundle\Manager\BagManagerConfigurationInterface;

/**
 * This class contains configuration for zf1 namespaces
 *
 * @author Jean Ashton <jeana@theodo.fr>
 * @author Marek Kalnik <marekk@theodo.fr>
 */
class BagConfiguration implements BagManagerConfigurationInterface
{

    /**
     * Array of the session's namespaces in ZendFramework 1
     * @var array
     */
    private $namespaces;

    /**
     * Argument is set in app/config.yml
     * @param $zf1Namespaces
     */
    public function __construct($zf1Namespaces) {
        $this->namespaces = $zf1Namespaces;
    }

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

    public function isArray($namespaceName)
    {
        return true;
    }
}