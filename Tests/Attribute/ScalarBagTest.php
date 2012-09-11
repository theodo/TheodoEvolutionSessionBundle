<?php

namespace TheodoEvolution\HttpFoundationBundle\Tests\Attribute;

use TheodoEvolution\HttpFoundationBundle\Attribute\ScalarBag;

/**
 * ScalarBag class.
 *
 * @author Benjamin Grandfond <benjamin.grandfond@gmail.com>
 */
class ScalarBagTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getSessions
     * @param $session
     * @param $expected
     */
    public function testInitialize($session, $expected)
    {
        $bag = new ScalarBag('');
        $bag->initialize($session);

        $this->assertEquals($expected, $bag->get());
    }

    public function getSessions()
    {
        return array(
            array(array('foo'), 'foo'),
            array(array('foo', 'bar'), 'foo'),
            array(array(), null),
        );
    }
}
