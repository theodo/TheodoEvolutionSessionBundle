<?php
namespace TheodoEvolution\HttpFoundationBundle\Manager;

/**
 * This interface assures that proper session namespace handling
 */
interface BagManagerConfigurationInterface
{
    const LAST_REQUEST_NAMESPACE = 'last_request_namespace';
    const AUTH_NAMESPACE = 'auth_namespace';
    const CREDENTIAL_NAMESPACE = 'credential_namespace';
    const ATTRIBUTE_NAMESPACE = 'attribute_namespace';
    const CULTURE_NAMESPACE = 'culture_namespace';

    /**
     * Gets a list of all session namespaces used by application.
     * A session namespace is a key in $_SESSION array.
     *
     * @return array
     */
    public function getNamespaces();

    /**
     * Returns if the namespace is an array of namespaces.
     * Use for nested session values.
     *
     * @param string $namespaceName
     *
     * @return boolean
     */
    public function isArray($namespaceName);
}
