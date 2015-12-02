<?php

namespace DC\ExcelServiceProvider\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class ExcelServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['excel'] = $app->share(function ($app) {
            return new \DC\ExcelServiceProvider\Generator\Excel();
        });
    }

    public function boot(Application $app) {}
}