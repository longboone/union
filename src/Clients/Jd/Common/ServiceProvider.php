<?php

namespace Young\Union\Clients\Jd\Common;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['common'] = function ($app) {
            return new Client($app);
        };
    }
}
