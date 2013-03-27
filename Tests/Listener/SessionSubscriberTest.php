<?php

namespace Theodo\Evolution\Bundle\SessionIntegrationBundle\Listener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Theodo\Evolution\Bundle\SessionIntegrationBundle\Listener\SessionSubscriber;

class SessionSubscriberTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->request = $this->getMock('Symfony\Component\HttpFoundation\Request');
        $this->bagManager = $this->getMock('Theodo\Evolution\Bundle\SessionIntegrationBundle\Manager\BagManagerInterface');
        $this->listener = new SessionSubscriber($this->bagManager);

        $this->request->expects($this->any())
            ->method('getSession')
            ->will(
                $this->returnValue(
                    $this->getMock('Symfony\Component\HttpFoundation\Session\SessionInterface')
                )
            );

        $this->eventMock = $this->getMockBuilder('Symfony\Component\HttpKernel\Event\GetResponseEvent')
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventMock->expects($this->any())
            ->method('getRequest')
            ->will($this->returnValue($this->request));
    }

    /**
     * @dataProvider getRequestExpectations
     */
    public function testIsInitializedOnMasterRequestAndHasSession($requestType, $hasSession, $shouldInitialize)
    {
        $this->eventMock->expects($this->once())
            ->method('getRequestType')
            ->will($this->returnValue($requestType));

        $this->request->expects($this->any())
            ->method('hasSession')
            ->will($this->returnValue($hasSession));

        $this->bagManager->expects($shouldInitialize ? $this->once() : $this->never())
            ->method('initialize');

        $this->listener->onKernelRequest($this->eventMock);
    }

    public function getRequestExpectations()
    {
        return array(
            array(HttpKernelInterface::MASTER_REQUEST, true, true),
            array(HttpKernelInterface::MASTER_REQUEST, false, false),
            array(HttpKernelInterface::SUB_REQUEST, false, false),
            array(HttpKernelInterface::SUB_REQUEST, true, false),
        );
    }
}
