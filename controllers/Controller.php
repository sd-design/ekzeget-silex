<?php
namespace controllers;

use Silex\Application;
use Silex\ControllerCollection;

abstract class Controller
{
    protected $app;
    protected $layout = 'main';
    protected $templateNameSpace;

    public function __construct(Application $app) {
        $this->app = $app;
    }

    // routes request to specific controller based on first segment of url path
    final public static function routeRequest(Application $app, $url)
    {
        $controllerSegment = self::extractController($url);
        $controllerCls = __NAMESPACE__ . '\\' . ucfirst($controllerSegment) . 'Controller';
        (new $controllerCls($app))->load($controllerSegment);
    }

    protected function load($controllerSegment)
    {
        $this->templateNameSpace = $this->templateNameSpace ?? $controllerSegment;
        $controllersFactory = $this->app['controllers_factory'];
        $this->defineActions($controllersFactory);
        if ($controllerSegment === 'index') {
            $this->app->mount('/', $controllersFactory);
        } else {
            $this->app->mount('/' . $controllerSegment, $controllersFactory);
        }
    }

    // defines so called "actions"(in Yii terms) - a bunch of controllers for each sub segment
    abstract protected function defineActions(ControllerCollection $controllerCollection);

    private static function extractController($url)
    {
        if (!$url || $url === '/') {return 'index';}
        $matches = [];
        preg_match('#/(.*?)/#', $url, $matches);
        return $matches[1] ?? 'notFound';
    }

    public function render($template, Array $parameters = [], $loadLayout = true, $layout = null)
    {
        return  $this->app['view']($layout ?? $this->layout)
            ->render($this->templateNameSpace . '/' . $template, $parameters, $loadLayout);
    }
}