<?php

/*
 * This file is part of HashidsServiceProvider.
 *
 * (c) Jimmy Leger <jimmy.leger@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Redpanda\Silex\Provider;

use Hashids\Hashids;
use Silex\Application;
use Silex\ServiceProviderInterface;

class HashidsServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['hashids.default_options'] = array(
            'salt'            => '',
            'min_hash_length' => 0,
            'alphabet'        => ''
        );

        $app['hashids'] = $app->share(function() use ($app) {
            $container = new \Pimple();

            foreach ($app['hashids.options'] as $name => $options) {
                $options = array_replace($app['hashids.default_options'], $options);

                $container[$name] = $container->share(function() use ($options) {
                    return new Hashids(
                        $options['salt'],
                        $options['min_hash_length'],
                        $options['alphabet']
                    );
                });
            }

            return $container;
        });
    }

    public function boot(Application $app)
    {
    }
}
