<?php

namespace DC\ExcelServiceProvider\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class ExcelServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['excel'] = $app->protect(function ($name) use ($app) {
            $excelService = new \DC\ExcelServiceProvider\Generator\Excel();
            return $excelService;
        });
    }

    public function boot(Application $app) {}
}