<?php
namespace services;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class ViewServiceProvider implements ServiceProviderInterface
{
    private $layout;
    private $firstLevelTmplDir, $firstLevelTmpl, $isFirstLevel = true;
    private $assets;
    protected $widgets = [];


    protected function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($template, Array $parameters = [], $loadLayout = true)
    {
        if ($this->isFirstLevel) {
            $parameters['response'] = new Response();
            $this->init($template, $parameters);

            $renderedTemplate = $this->loadTemplate($this->firstLevelTmpl, $parameters);

            $result =  ($loadLayout
                        ? $this->loadLayout($renderedTemplate)
                        : $renderedTemplate
            );

            $parameters['response']->setContent($result);
            return $parameters['response'];
        }

        return $this->loadTemplate($template, $parameters);
    }

    public function renderTemplate($template, Array $parameters = [])
    {
        return $this->render($template, $parameters, false);
    }

    private function loadLayout($contents)
    {
        $app = get_app();
        $base_url = $app['base.url'];
        $page_title = $app['page.title'];
        $assets = $app['assets.url'];
        include $this->findLayout();
        return ob_get_clean();
    }

    public function loadTemplate($template, Array $parameters)
    {
        extract($parameters);
        $app = get_app();
        $base_url = $app['base.url'];
        $page_title = $app['page.title'];
        $assets = $app['assets.url'];
        ob_start();
        include ($template[0] === '/' ? $template : $this->findTemplate($template)); //available parameters, $this(View) and $app
        return ob_get_clean();
    }

    private function findLayout()
    {
        $layoutPath =  $_SERVER['DOCUMENT_ROOT'] . '/../src/views/layouts/' . $this->layout . '.php';
        $this->checkAccess($this->layout, $layoutPath);
        return $layoutPath;
    }

    private function findTemplate($template)
    {
        $templatePath =  $_SERVER['DOCUMENT_ROOT'] . '/../src/views/' . $this->firstLevelTmplDir . '/' . $template . '.php';
        $this->checkAccess($template, $templatePath);
        return $templatePath;
    }

    private function checkAccess($templateName, $templatePath)
    {
        if (!is_readable($templatePath)) {
            throw new FileNotFoundException("шаблон $templateName ($templatePath) не найден");
        }
    }

    private function init($template, Array $parameters = [])
    {
        $this->isFirstLevel = false;
        $this->firstLevelTmplDir = dirname($template);
        $this->firstLevelTmpl = basename($template);
        if (isset($parameters['widgets'])) {
            $this->widgets = $parameters['widgets'];
        }
        ob_start();
    }

    public function register(Container $app) {
        $app['view'] = $app->protect((function ($layout) use ($app) {
            $that = clone $this;
            $that->setLayout($layout);
            return $that;
        })->bindTo($this));
    }

    public function setAssets($assets)
    {
        $this->assets = $assets;
    }

    public function setProp($prop, $value)
    {
        $prop = '__' . $prop;
        $this->$prop = $value;
    }

    public function getProp($prop)
    {
        $prop = '__' . $prop;
        if (isset($this->$prop)) {
            return $this->$prop;
        }
        return '';
    }

    public function setTitle($value)
    {
        $this->setProp('title', $value);
    }

    public function getTitle()
    {
        return $this->getProp('title');
    }

    public function assets()
    {
        echo $this->assets;
    }
}