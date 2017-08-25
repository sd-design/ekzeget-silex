<?php
namespace controllers;


use Silex\Application;
use Silex\ControllerCollection;
use services\URLS;
use Symfony\Component\HttpFoundation\Request;

class DonationController extends Controller
{

    
    protected $layout = 'empty';

    protected function defineActions(ControllerCollection $auth) {

        $auth->get('/', function (Application $app, Request $request)
            {
                $app['page.title']= "Пожертвовать";
                return $this->render('index', [
                    'user' => 'hello user'
                ]);
            });

        }

}
