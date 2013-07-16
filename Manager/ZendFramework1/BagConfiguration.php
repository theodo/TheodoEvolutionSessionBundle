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
        BagManagerConfigurationInterface::LAST_REQUEST_NAMESPACE => 'symfony/user/sfUser/lastRequest',
        BagManagerConfigurationInterface::AUTH_NAMESPACE         => 'symfony/user/sfUser/authenticated',
        BagManagerConfigurationInterface::CREDENTIAL_NAMESPACE   => 'symfony/user/sfUser/credentials',
        BagManagerConfigurationInterface::CULTURE_NAMESPACE      => 'symfony/user/sfUser/culture',
    );

    private $zf1Namespaces;

    public function __construct($zf1MainNamespace, $zf1Namespaces) {
        $this->namespaces[BagManagerConfigurationInterface::ATTRIBUTE_NAMESPACE] = $zf1MainNamespace;
        $this->zf1Namespaces = $zf1Namespaces;
    }

    /**
     * {@inheritdoc}
     */
    public function getNamespaces()
    {
        return $this->namespaces;
    }

    public function getZf1MainNamespace() {
        return $this->namespaces[BagManagerConfigurationInterface::ATTRIBUTE_NAMESPACE];
    }

    /**
     * Returns the zend session's namespaces
     * @return array
     */
    public function getZf1Namespaces(){
        return $this->zf1Namespaces;
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