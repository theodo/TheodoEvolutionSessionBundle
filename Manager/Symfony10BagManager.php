<?php

namespace TheodoEvolution\HttpFoundationBundle\Manager;

use TheodoEvolution\HttpFoundationBundle\Manager\BagManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Attribute\NamespacedAttributeBag;
use TheodoEvolution\HttpFoundationBundle\Manager\Symfony10BagNamespaces;
use TheodoEvolution\HttpFoundationBundle\Attribute\ScalarBag;

/**
 * EvolutionAttributeBag class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 */
class Symfony10BagManager implements BagManagerInterface
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Create bags for each namespaces (see constants of this class).
     */
    public function initialize(SessionInterface $session)
    {
        // If you consider this unnecessary, please take into account the author's enthusiasm for new technologies
        $reflection = new \ReflectionClass('\TheodoEvolution\HttpFoundationBundle\Manager\Symfony10BagNamespaces');
        $namespaces = $reflection->getConstants();

        foreach ($namespaces as $namespace) {
            if ($this->isArray($namespace)) {
                $bag = new NamespacedAttributeBag($namespace, '.');
            } else {
                $bag = new ScalarBag($namespace);
            }
            $bag->setName($namespace);
            $session->registerBag($bag);
        }

        $session->getBag(Symfony10BagNamespaces::LAST_REQUEST_NAMESPACE)->set(time());
        $session->getBag(Symfony10BagNamespaces::CULTURE_NAMESPACE)->set($this->container->getParameter('kernel.default_locale'));
    }

    /**
     * Returns true if the namespace is an array in session
     * @param $namespace
     * @return bool
     */
    protected function isArray($namespace)
    {
        switch ($namespace) {
            case Symfony10BagNamespaces::ATTRIBUTE_NAMESPACE:
            case Symfony10BagNamespaces::CREDENTIAL_NAMESPACE:
                return true;
            default:
                return false;
        }
    }
}
