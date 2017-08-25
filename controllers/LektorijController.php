<?php
namespace controllers;


use Silex\Application;
use Silex\ControllerCollection;
use services\URLS;
use Symfony\Component\HttpFoundation\Request;

class LektorijController extends Controller
{

    
    protected $layout = 'lektorij';

    protected function defineActions(ControllerCollection $auth) {

        $auth->get('/', function (Application $app, Request $request)
            {
                $app['page.title']= "Лекторий";
                return $this->render('index', [
                    'user' => 'hello user'
                ]);
            });

        }

}
