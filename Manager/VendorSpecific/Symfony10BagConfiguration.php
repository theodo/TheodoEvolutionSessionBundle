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
    private static $namespaces = array(
        BagManagerConfigurationInterface::LAST_REQUEST_NAMESPACE => 'symfony/user/sfUser/lastRequest',
        BagManagerConfigurationInterface::AUTH_NAMESPACE         => 'symfony/user/sfUser/authenticated',
        BagManagerConfigurationInterface::CREDENTIAL_NAMESPACE   => 'symfony/user/sfUser/credentials',
        BagManagerConfigurationInterface::ATTRIBUTE_NAMESPACE    => 'symfony/user/sfUser/attributes',
        BagManagerConfigurationInterface::CULTURE_NAMESPACE      => 'symfony/user/sfUser/culture',
    );

    /**
     * {@inheritdoc}
     */
    public static function getNamespaces()
    {
        return self::$namespaces;
    }

    public function isArray($namespaceName)
    {
        switch ($namespaceName) {
            case self::$namespaces['attribute_namespace']:
            case self::$namespaces['credential_namespace']:
                return true;
            default:
                return false;
        }
    }
}
