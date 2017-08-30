<?php
namespace controllers;


use models\PageQuery;
use services\URLS;
use Silex\Application;
use Silex\ControllerCollection;

class PageController extends Controller
{

    protected function defineActions(ControllerCollection $page)
    {
     
                $page->get(URLS::ALL['PAGE'], function (Application $app, $code) {
  
                if($code=="list"){
                        $pages = PageQuery::create()
                        ->find();
                        return $this->render('page_list',
                        [
                            'pages'    => $pages,
                        ]
                    );
                }
            else{
                    $page = PageQuery::create()
                        ->findOneByCode($code);

                    return $this->render('page',
                        [
                            'page'    => $page,
                            'widgets' => $page->getPositionedWidgets()
                        ]
                    );
                }
                    });
                
            

 
    }
}