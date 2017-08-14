<?php

namespace services;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ShortcutTranslationServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        if (isset($app['translator'])) {
            $app['t'] = $app->protect(function (...$params) use($app) {
                return $app['translator']->trans(...$params);
            });
        }
    }
}