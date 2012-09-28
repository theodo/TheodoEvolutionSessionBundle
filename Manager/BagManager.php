<?php
namespace TheodoEvolution\HttpFoundationBundle\Manager;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Attribute\NamespacedAttributeBag;
use TheodoEvolution\HttpFoundationBundle\Attribute\ScalarBag;

/**
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 * @author Marek Kalnik <marekk@theodo.fr>
 */
class BagManager implements BagManagerInterface
{
    protected $configuration;

    public function __construct(BagManagerConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(SessionInterface $session)
    {
        $namespaces = $this->configuration->getNamespaces();

        foreach ($namespaces as $namespace) {
            if ($this->configuration->isArray($namespace)) {
                $bag = new NamespacedAttributeBag($namespace, '.');
            } else {
                $bag = new ScalarBag($namespace);
            }
            $bag->setName($namespace);
            $session->registerBag($bag);
        }
    }
}
