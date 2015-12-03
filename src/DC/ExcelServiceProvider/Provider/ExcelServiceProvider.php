<?php

namespace DC\ExcelServiceProvider\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class ExcelServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['excel'] = $app->share(function ($app) {

            $doctrine = null;
            if(isset($app['db'])) {
                return new \DC\ExcelServiceProvider\Generator\ExcelDoctrine($app['db']);
            }
            return new \DC\ExcelServiceProvider\Generator\Excel();
        });
    }

    public function boot(Application $app) {}
}