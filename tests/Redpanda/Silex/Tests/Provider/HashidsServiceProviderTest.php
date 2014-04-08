<?php

use Silex\Application;
use Redpanda\Silex\Provider\HashidsServiceProvider;

class HashidsServiceProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testRegister()
    {
        $app = new Application();
        $app->register(new HashidsServiceProvider(), array(
            'hashids.options' => array(
                'foo' => array(
                    'salt' => 'foo',
                    'min_hash_length' => 5,
                    'alphabet' => ''
                ),
                'bar' => array(
                    'salt' => 'bar',
                    'min_hash_length' => 6,
                    'alphabet' => ''
                )
            )
        ));

        $this->assertInstanceOf('\Pimple', $app['hashids']);
        $this->assertInstanceOf('\Hashids\Hashids', $app['hashids']['foo']);
        $this->assertInstanceOf('\Hashids\Hashids', $app['hashids']['bar']);

        $hash = $app['hashids']['foo']->encrypt(1, 2, 3);
        $numbers = $app['hashids']['foo']->decrypt($hash);

        $this->assertTrue(is_string($hash));
        $this->assertSame(array(1,2,3), $numbers);
    }
}
