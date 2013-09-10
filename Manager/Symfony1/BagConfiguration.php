<?php

namespace Theodo\Evolution\Bundle\SessionBundle\Manager\Symfony1;

use Theodo\Evolution\Bundle\SessionBundle\Manager\BagManagerConfigurationInterface;

/**
 * This class contains configuration for Symfony 1.x namespaces
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 * @author Marek Kalnik <marekk@theodo.fr>
 */
class BagConfiguration implements BagManagerConfigurationInterface
{
    const LAST_REQUEST_NAMESPACE = 'last_request_namespace';
    const AUTH_NAMESPACE = 'auth_namespace';
    const CREDENTIAL_NAMESPACE = 'credential_namespace';
    const ATTRIBUTE_NAMESPACE = 'attribute_namespace';
    const CULTURE_NAMESPACE = 'culture_namespace';

    private $namespaces = array(
        self::LAST_REQUEST_NAMESPACE => 'symfony/user/sfUser/lastRequest',
        self::AUTH_NAMESPACE         => 'symfony/user/sfUser/authenticated',
        self::CREDENTIAL_NAMESPACE   => 'symfony/user/sfUser/credentials',
        self::ATTRIBUTE_NAMESPACE    => 'symfony/user/sfUser/attributes',
        self::CULTURE_NAMESPACE      => 'symfony/user/sfUser/culture',
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
