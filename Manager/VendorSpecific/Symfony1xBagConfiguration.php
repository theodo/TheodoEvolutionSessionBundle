<?php

namespace Theodo\Evolution\Bundle\SessionIntegrationBundle\Manager\VendorSpecific;

use Theodo\Evolution\Bundle\SessionIntegrationBundle\Manager\BagManagerConfigurationInterface;

/**
 * This class contains configuration for Symfony 1.x namespaces
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @author Marek Kalnik <marekk@theodo.fr>
 */
class Symfony1xBagConfiguration implements BagManagerConfigurationInterface
{
    private $namespaces = array(
        BagManagerConfigurationInterface::LAST_REQUEST_NAMESPACE => 'symfony/user/sfUser/lastRequest',
        BagManagerConfigurationInterface::AUTH_NAMESPACE         => 'symfony/user/sfUser/authenticated',
        BagManagerConfigurationInterface::CREDENTIAL_NAMESPACE   => 'symfony/user/sfUser/credentials',
        BagManagerConfigurationInterface::ATTRIBUTE_NAMESPACE    => 'symfony/user/sfUser/attributes',
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
