<?php
namespace controllers;


use models\PageQuery;
use Silex\Application;
use services\URLS;
use Silex\ControllerCollection;

class LektorijController extends Controller
{

    
    protected $layout = 'lektorij';

    protected function defineActions(ControllerCollection $lektorij) {   

        $lektorij->get('/', function (\Application $app) {
            
                        $app['page.title']= "Лекторий";
                        return $this->render('index');
                    });
        $lektorij->get(URLS::ALL['LEKTORIJ_LIST'], function (\Application $app, $id) {
                        
                                    $app['page.title']= "Лекторий";
                                    $pages = PageQuery::create()
                                    ->findByCategoryId($id);
                        
                                return $this->render('index',
                                    [
                                        'pages'    => $pages,
                        
                                    ]
                                );
                                });

        $lektorij->get(URLS::ALL['LEKTORIJ'], function (\Application $app, $code) {

            $page = PageQuery::create()
            ->findOneByCode($code);
            $app['page.title']= $page->getTitle();
        return $this->render('lek_page',
            [
                'page'    => $page,

            ]
        );
        });
       

    }

}
