<?php
namespace controllers;


use Silex\Application;
use Silex\ControllerCollection;
use services\URLS;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends Controller
{

    
    protected $layout = 'user';

    protected function defineActions(ControllerCollection $auth) {

        $auth->get('/', function (Application $app, Request $request)
            {
                $app['page.title']= "Вход";
                return $this->render('login', [
                    'user' => 'hello user'
                ]);
            });


            $auth->get('/login', function (Application $app, Request $request)
            {
                $app['page.title']= "Вход";
                
                return $this->render('login', [
                    'user' => 'hello user'
                ]);
            });
        }

}
