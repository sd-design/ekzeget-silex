<?php
namespace controllers;

use services\URLS;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;


class MapsController extends Controller
{
    protected $layout='maps';
    protected function defineActions(ControllerCollection $maps)
    {
     
        $maps->get('/', function (\Application $app) {
        
            $app['page.title']= "Библейские карты";
                return $this->render('index');
    
                        
        }); 
    }
}
