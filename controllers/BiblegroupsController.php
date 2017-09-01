<?php
namespace controllers;

use models\Category;
use models\CategoryQuery;
use services\URLS;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;


class BIblegroupsController extends Controller
{
    protected $layout='lektorij';
    protected function defineActions(ControllerCollection $group)
    {
     
        $group->get('/', function (\Application $app) {
        
            return $this->render('index');
                        
        }); 


        $group->get(URLS::ALL['CATEGORY'], function (\Application $app, $slug) {

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

        return $this->render('group_page',
            [
                'cat'    => $cat,
            ]
        );
    }
});


    }
}
