<?php
namespace controllers;


use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class LoginController extends Controller
{
    //protected $layout = 'inside';

    protected function defineActions(ControllerCollection $Login) {
        $Login->get('/', function (Application $app, Request $request)
            {
                return $this->render('login', [
                    'user' => 'hello user'
                ]);
            });
        }

}
