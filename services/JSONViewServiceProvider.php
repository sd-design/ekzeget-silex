<?php
namespace services;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;

class JSONViewServiceProvider implements ServiceProviderInterface
{
    private $layout;
    protected $widgets = [];


    protected function setLayout($layout)
    {
        $this->layout = $layout;
    }

    private function getActiveRecordData(ActiveRecordInterface $item) {
        return method_exists($item, 'getTranslation')
            ? array_merge($item->toArray(), $item->getTranslation(get_app()['current_locale'])->toArray())
            : $item->toArray();
    }

    private function parseArray(Array $arr) {
        $result = [];
        foreach ($arr as $attr => $item) {
            $result[$attr] = $item instanceof ActiveRecordInterface ? $this->getActiveRecordData($item) : $item;
            if (is_array($item)) {
                $result[$attr] = $this->parseArray($item);
            }
        }
        return $result;
    }

    public function render($template, Array $parameters = [], $loadLayout = true)
    {
        $result = [];
        foreach ($parameters as $name => $param) {
           if ($param instanceof Collection) {
               $result[$name] = [];
               $data = $param->getData();
               foreach ($data as $attr => $item) {
                   $result[$name][$attr] = $item instanceof ActiveRecordInterface ? $this->getActiveRecordData($item) : $item;
               }
           } elseif(is_array($param)) {
               $result[$name] = $this->parseArray($param);
           } elseif ($param instanceof ActiveRecordInterface) {
               $result[$name] = $this->getActiveRecordData($param);
           } elseif(is_scalar($param)) {
               $result[$name] = $param;
           }
       }
       return get_app()->json($result);
    }

    public function loadTemplate(...$params)
    {
        return $this->render(...$params);
    }


    public function register(Container $app) {
        $app['view'] = $app->protect((function ($layout) use ($app) {
            return $this;
        })->bindTo($this));
    }
}