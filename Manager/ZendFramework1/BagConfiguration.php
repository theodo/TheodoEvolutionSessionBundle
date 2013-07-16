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
    private $namespaces = array(
        BagManagerConfigurationInterface::ATTRIBUTE_NAMESPACE    => 'mysession',
        BagManagerConfigurationInterface::LAST_REQUEST_NAMESPACE => 'symfony/user/sfUser/lastRequest',
        BagManagerConfigurationInterface::AUTH_NAMESPACE         => 'symfony/user/sfUser/authenticated',
        BagManagerConfigurationInterface::CREDENTIAL_NAMESPACE   => 'symfony/user/sfUser/credentials',
        BagManagerConfigurationInterface::CULTURE_NAMESPACE      => 'symfony/user/sfUser/culture',
    );

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
        switch ($namespaceName) {
            case $this->namespaces['attribute_namespace']:
            case $this->namespaces['credential_namespace']:
                return true;
            default:
                return false;
        }
    }
}
