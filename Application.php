<?php

use Silex\Application\UrlGeneratorTrait;

class Application extends Silex\Application {
    use UrlGeneratorTrait {
        url as protected  statelessUrl;
    }

    private $skipQueryStr = true;

    public function url($route, $parameters = array())
    {
        $queryString =
            ($this->skipQueryStr || !strlen($this['request_context']->getQueryString()))
            ? ''
            : '?' . $this['request_context']->getQueryString();

        $this->skipQueryStr = true;

        return $this->statelessUrl($route, $parameters) . $queryString;
    }

    public function withQuery() : Application
    {
        $this->skipQueryStr = false;
        return $this;
    }
}
