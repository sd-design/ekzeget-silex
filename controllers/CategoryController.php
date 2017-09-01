<?php
namespace controllers;

use models\Category;
use models\CategoryQuery;
use services\URLS;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;


class CategoryController extends Controller
{
    protected $layout='empty';
    protected function defineActions(ControllerCollection $cat)
    {
     
        $cat->get(URLS::ALL['CATEGORY'], function (\Application $app, $slug) {
        
            if($slug=="list"){
                $cats = CategoryQuery::create()
                ->find();
                return $this->render('cat_list',
                [
                    'cats'    => $cats,
                ]
            );
        }
    else{
            $cat = CategoryQuery::create()
                ->findOneBySlug($slug);

            return $this->render('cat_page',
                [
                    'cat'    => $cat,
                ]
            );
        }
                        
        }); 
    }
}
