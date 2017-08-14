<?php

namespace controllers;


use models\Base\AuthorI18nQuery;
use models\Base\AuthorQuery;
use models\Base\BookQuery;
use models\BookI18n;
use services\URLS;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NotFoundController extends ErrorController
{
    public static function resolveForKniga(Array $params, int $paramsQTY) : Response
    {
        $newUrl = '';

        if (isset($params['kn'])) {
            $book = self::knToBook($params['kn']);
            $newUrl = get_app()->url(
                URLS::ALL['BIBLE_BOOK'],
                ['book' =>  $book->getAbbreviation()]
            );
        }


        if (isset($params['tolk'], $book)) {
            $authorSlug =  AuthorI18nQuery::create()->filterByLocale('ru_RU')->findOneByName($params['tolk'])->getSlug();
            $newUrl =  get_app()->url(
                URLS::ALL['COMMENTARY_BOOK'],
                ['book' => $book->getAbbreviation(), 'authorSlug' => $authorSlug]
            );
        }

        return $newUrl
            ? get_app()->redirect($newUrl, 301)
            : self::throw();
    }

    public static function resolveForTolk_info(Array $params, int $paramsQTY) : Response
    {
        if (isset($params['tolk'])) {
            $authorName = $params['tolk'];
            $author = AuthorQuery::create()->useI18nQuery('ru_RU')->findOneByName($authorName);

            $newUrl = get_app()->url(
                URLS::ALL['COMMENTARY_AUTHOR'],
                ['slug' => $author->getSlug()]
            );
            return get_app()->redirect($newUrl, 301);
        }

        return self::throw();
    }

    public static function resolveForGlava(Array $params, int $paramsQTY) : Response
    {
        if (isset($params['kn'], $params['gl'])) {
            $book = self::knToBook($params['kn']);
            $newUrl =  get_app()->url(
                URLS::ALL['BIBLE_BOOK_CHAPTER'],
                ['book' => $book->getAbbreviation(), 'chapterNum' => $params['gl']]
            );
            return get_app()->redirect($newUrl, 301);
        }

        return self::throw();
    }

    public static function error(\Throwable $e, Request $request = null, $code = null) : Response
    {
        $scriptName = basename($request->getPathInfo(), '.php');
        $resolverName = 'resolveFor' . ucfirst($scriptName);
        $params = self::encode($request->query->all());

        return method_exists(self::class, $resolverName)
            ? self::$resolverName($params, $request->query->count())
            : self::throw();
    }

    public static function throw() : Response
    {
        $ctrl = new NotFoundController(get_app());
        return $ctrl->render('404');
    }

    public static function terminate()
    {
        echo (new NotFoundController(get_app()))->throw()->getContent();
        die();
    }

    protected function defineActions(ControllerCollection $controllerCollection)
    {
        get_app()->error([$this, 'error'], INF);
    }

    private static function encode(Array $params) : array
    {
        return array_map(
            function ($param) {
                return iconv("windows-1251", "utf-8", $param);
            },
            $params
        );
    }

    public static function knToBook(string $kn) : BookI18n
    {
        /** @var string $kn_sokr */
        include '/var/www/ekzeget.ru/public_html/FILES/sokr.txt';
        if (!isset($kn_sokr)) {
            self::terminate();
        }
        $kn_sokr = str_replace(' ', '', $kn_sokr);
        $kn_sokr = str_replace('.', '', $kn_sokr);
        $kn_sokr = iconv("windows-1251", "utf-8", $kn_sokr);
        $kn_sokr = preg_replace('/^(\d)/', '\1 ', $kn_sokr);
        $book = BookQuery::create()->useI18nQuery('ru_RU')->findOneByAbbreviation($kn_sokr)->setLocale('en_US');
        $book->reload();
        return $book;
    }
}