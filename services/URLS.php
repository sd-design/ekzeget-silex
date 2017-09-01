<?php

namespace services;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Route;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RouteCollection;

//TODO: PhpMatcherDumper for each CONTROLLER_?
class URLS implements ServiceProviderInterface
{
    const ALL = [
        'PAGE'                           =>  '/{code}/',
        'CATEGORY'                       =>  '/{slug}/',
        'BIBLE_BOOK'                     =>  '/{book}/',
        'BIBLE_BOOK_CHAPTER'             =>  '/{book}/{chapterNum}/',
        'BIBLE_BOOK_CHAPTER_VERSE'       =>  '/{book}/{chapterNum}/{verse}/',
        'COMMENTARY_BOOK'                =>  '/{authorSlug}/book/{book}/',
        'COMMENTARY_CHAPTER'             =>  '/{authorSlug}/{book}/{chapterNum}/',
        'COMMENTARY_VERSE'               =>  '/{authorSlug}/{pointer}/',
        'COMMENTARY_AUTHOR'              =>  '/author/{slug}/',
        'COMMENTARY_AUTHOR_ALL'          =>  '/author/{slug}/all/',
        'COMMENTARY_AUTHORS'             =>  '/authors/',
        'LEKTORIJ'                       =>  '/{code}/',
        'LEKTORIJ_LIST'                  =>  '/list/{id}/',
        'SEARCH_SUGGEST'                 =>  '/suggest/{query}/',
        'SEARCH'                         =>  '/{query}/',

        'ADMIN_COMMENTARY_ADD'           =>  '/commentary/add/',
        'ADMIN_AUTHOR_ADD'               =>  '/author/add/',
        'ADMIN_COMMENTARY_BOOK_ADD'      =>  '/commentary/book/add/',
        'ADMIN_COMMENTARY_EDIT'          =>  '/commentary/{id}/',
        'ADMIN_AUTHOR_EDIT'              =>  '/author/{id}/',
        'ADMIN_COMMENTARY_BOOK_EDIT'     =>  '/commentary/book/{id}/',
        'ADMIN_TABLE'                    =>  '/{table}/',
        'ADMIN_GALLERY'                  =>  '/gallery/',
        'DEMO'                          => '/{demos}/{demos1}/',
        'CALENDAR'                      => '/{cadate}/',
    ];


    public function register(Container $app)
    {
        $app['routes4generator'] = new RouteCollection();
        foreach (static::ALL as $name => $path) {
            $ctrlSegment = '/' . strtolower(explode('_', $name)[0]);
            $route  = new Route($ctrlSegment . $path);
            $app['routes4generator']->add($path, $route);
        }

        $app['request_context']->setHost(''); //in case of fatal error, before $app->run()

        $app['url_generator'] = function ($app) {
            return new UrlGenerator($app['routes4generator'], $app['request_context']);
        };
    }
}