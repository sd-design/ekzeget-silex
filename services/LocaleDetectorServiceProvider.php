<?php
namespace services;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Silex\Application;

class LocaleDetectorServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    public function register(Container $app)
    {
        $app['current_locale'] = function() use ($app) {
            $langSubdomain = explode('.', $_SERVER['HTTP_HOST'])[0];
            $currentLocale = $app['supported_langs'][$langSubdomain]
                ?? $app['supported_langs']['ru'];

            setlocale(LC_ALL, $currentLocale . '.UTF-8');

            return $currentLocale;
        };
    }

    public function boot(Application $app)
    {
        $app['locale'] = $app['current_locale'];
    }
}