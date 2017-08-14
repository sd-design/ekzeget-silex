<?php

namespace controllers;


use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;

class WidgetController extends Controller
{

    protected function defineActions(ControllerCollection $widget)
    {
        $widget->get('/{widget}/', function (\Application $pap, Request $request, $widget){
            $widgetCls = 'widgets\\' . $widget;

            return $widgetCls::widget(iterator_to_array($request->query->getIterator()));
        });
    }
}