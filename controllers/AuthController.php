<?php
namespace controllers;


use Silex\Application;
use Silex\ControllerCollection;
use services\URLS;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends Controller
{
    protected $layout = 'inside';

    protected function defineActions(ControllerCollection $auth) {
        $auth->get('', function (Application $app, Request $request)
            {
                return $this->render('login', [
                    'user' => 'hello user'
                ]);
            });
        }

}
