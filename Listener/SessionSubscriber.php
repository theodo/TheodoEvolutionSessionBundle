<?php

namespace Theodo\Evolution\Bundle\SessionBundle\Listener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Theodo\Evolution\Bundle\SessionBundle\Manager\BagManagerInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Add evolution parameters bag in the session.
 *
 * @author Benjamin Grandfond <benjaming@theodo.fr>
 */
class SessionSubscriber implements EventSubscriberInterface
{
    /**
     * @var \Theodo\EvolutionBundle\Session\Manager\BagManagerInterface
     */
    private $bagManager;

    /**
     * @param \Theodo\EvolutionBundle\Session\Manager\BagManagerInterface $bagManager
     */
    public function __construct(BagManagerInterface $bagManager)
    {
        $this->bagManager = $bagManager;
    }

    /**
     * Initializes the bag manager if it has not yet been done
     *
     * @param  GetResponseEvent $event
     * @return mixed
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()
            || false == $event->getRequest()->hasSession()
        ) {
            return;
        }

        $this->bagManager->initialize($event->getRequest()->getSession());
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => (array('onKernelRequest', 127))
        );
    }
}
