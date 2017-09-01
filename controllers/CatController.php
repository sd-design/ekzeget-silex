<?php
namespace controllers;

use models\Category;
use models\CategoryQuery;
use models\PageQuery;
use services\URLS;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;


class CatController extends Controller
{

    protected function defineActions(ControllerCollection $cat)
    {
     
        $cat->get('/list/', function (\Application $app) {
          
            $cats = CategoryQuery::create()
            ->find();
            print_r($cats);
            exit();
            
            return $this->render('cat_page',
            [
                '$cats'    => $cats,
                
            ]
        );
     
                        
        }); 
    }
}
