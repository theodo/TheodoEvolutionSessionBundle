<?php
namespace TheodoEvolution\HttpFoundationBundle\Manager\VendorSpecific;

use TheodoEvolution\HttpFoundationBundle\Manager\BagManagerConfigurationInterface;

/**
 * This class contains configuration for Symfony 1.0 namespaces
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @author Marek Kalnik <marekk@theodo.fr>
 */
class Symfony10BagConfiguration implements BagManagerConfigurationInterface
{
    private $namespaces = array(
        'last_request_namespace' => 'symfony/user/sfUser/lastRequest',
        'auth_namespace'         => 'symfony/user/sfUser/authenticated',
        'credential_namespace'   => 'symfony/user/sfUser/credentials',
        'attribute_namespace'    => 'symfony/user/sfUser/attributes',
        'culture_namespace'      => 'symfony/user/sfUser/culture',
    );

    /**
     * {@inheritdoc}
     */
    public function getNamespaces()
    {
        return $this->namespaces;
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
