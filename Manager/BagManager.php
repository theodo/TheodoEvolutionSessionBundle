<?php
namespace Theodo\Evolution\Bundle\SessionIntegrationBundle\Manager;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Attribute\NamespacedAttributeBag;
use Theodo\Evolution\Bundle\SessionIntegrationBundle\Attribute\ScalarBag;

/**
 * @author Benjamin Grandfond <benjaming@theodo.fr>
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
            try {
                $session->getBag($namespace);
            } catch (\InvalidArgumentException $e) {
                // Only create bags if they do not exist
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
}
