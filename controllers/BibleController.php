<?php

namespace controllers;

use models\Book;
use models\BookQuery;
use models\Bible;
use models\BibleQuery;
use models\TraditionQuery;
use models\VersionQuery;
use services\URLS;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;

class BibleController extends Controller
{
    protected $layout = 'bible';

    protected function defineActions(ControllerCollection $Bible)
    {
        $Bible->convert('book', [BookQuery::class, 'findByCode']);

        $Bible->get(URLS::ALL['BIBLE_BOOK'], function (\Application $app, Request $request, Book $book) {
            $chapters = Bible::getChapters($app['bible_version'], $book);

            return $this->render('book', [
                    'abbr'      => $book->getCode(),
                    'book'      => $book->setLocale($app['current_locale']),
                    'chapters'  => $chapters,
                    'versesQTY' => Bible::countVerses($chapters),
                    'request'   => $request,
            ]);
        });

        $Bible->get(URLS::ALL['BIBLE_BOOK_CHAPTER'], function (\Application $app, Request $request, Book $book, $chapterNum) {
            $marker = new $app['bible.marker']($chapterNum, $request->get('marker_group'));

            $verses = BibleQuery::create()
                ->setMarker($marker)
                ->findVersesOfChapter($book, $chapterNum);

            return $this->render('chapter', [
                    'verses'     => $verses,
                    'chapterNum' => $chapterNum,
                    'bookCode'   => $book->getCode(),
                    'book'       => $book,
                    'marker'     => $marker,
                    'request'    => $request,
                    'chaptersQTY'=> Bible::getChapters($app['bible_version'], $book)->count(),
                    'commentedVerses' => TraditionQuery::create()->findCommentedVerses($verses),
                ]);
        });

        $Bible->get(URLS::ALL['BIBLE_BOOK_CHAPTER_VERSE'], function (\Application $app, Request $request, Book $book, $chapterNum, $verse) {
            $marker = new $app['bible.marker']($chapterNum, $request->get('marker_group'));

           $verse = BibleQuery::create()
                ->setMarker($marker)
                ->findVersionsOfVerse($book, $chapterNum, $verse);

            return $this->render('verse', [
                    'chapterNum'  => $chapterNum,
                    'bookCode'    => $book->getCode(),
                    'book'        => $book,
                    'verse'       => $verse,
                    'marker'      => $marker,
                    'request'     => $request,
                    'chaptersQTY' => Bible::getChapters($app['bible_version'], $book)->count(),
                    'versesQty'   => BibleQuery::create()->filterByBook($book)->filterByChapter($chapterNum)->filterByVersion(VersionQuery::create()->findByAbbreviation($app['bible_version']))->count()
                ]);
        });
    }
}