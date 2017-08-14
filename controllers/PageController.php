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

            $page = PageQuery::create()
                ->findOneByCode($code);
            if (!$page) {
                    $app->abort(404, $app['translator']->trans('not_found'));
            }

            return $this->render('page',
                [
                    'page'    => $page,
                    'widgets' => $page->getPositionedWidgets()
                ]
            );
        });
    }
}