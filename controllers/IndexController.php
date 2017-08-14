<?php
namespace controllers;


use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class IndexController extends Controller
{

    protected function defineActions(ControllerCollection $index)
    {
        $index->get('/', function (Application $app, Request $request) {
            //index page is a static page, so I load page controller and send inner redirect
            (new PageController($app))->load('page');
            $subRequest = Request::create($request->getUriForPath('/page/index/'), 'GET');
            return $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
        });
       
    }
}