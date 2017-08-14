<?php
namespace widgets;


abstract class Widget
{
    public function __construct(Array $config = [])
    {
        foreach ($config as $param => $value) {
            $this->$param = $value;
        }
    }

    abstract public function run();

    public static function widget(Array $config = [])
    {
        $widget = new static($config);
        return $widget->run();
    }

    public static function render($template, Array $parameters = [])
    {
        return get_app()['view']('')->loadTemplate($_SERVER['DOCUMENT_ROOT'] . '/../src/widgets/views/' . $template . '.php', $parameters);
    }
}