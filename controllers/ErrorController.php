<?php

namespace controllers;


use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;

class ErrorController extends Controller
{
    protected $layout = 'empty';
    protected $templateNameSpace = 'error';

    public static function error(\Throwable $e, Request $request = null, $code = null)
    {
        if ($e instanceof \Error) {
            self::fatalError($e);
        }

        switch ($code) {
            case 404:
                return NotFoundController::throw();
            default:
                return null;
        }
    }

    public static function fatalError(\Error $e)
    {
        if (
                strpos($e->getMessage(), 'Call to a member function get') === 0
            ||  strpos($e->getMessage(), 'Call to a member function set') === 0
            ||  strpos($e->getMessage(), 'not found') !== false
        ) {
            NotFoundController::terminate();
        }
        throw $e;
    }

    protected function defineActions(ControllerCollection $controllerCollection) {}
}