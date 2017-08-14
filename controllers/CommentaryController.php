<?php

namespace controllers;

use models\AuthorQuery;
use models\Bible;
use models\BibleQuery;
use models\BookQuery;
use models\Book;
use models\BookCommentaryQuery;
use models\TraditionQuery;
use models\VersionQuery;
use services\URLS;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;


class CommentaryController extends Controller
{

    protected function defineActions(ControllerCollection $commentary)
    {
        $commentary->get(URLS::ALL['COMMENTARY_BOOK'], function (\Application $app, Book $book, $authorSlug) {
            $author = AuthorQuery::create()->useI18nQuery($app['current_locale'])->findOneBySlug($authorSlug);
            $commentary = BookCommentaryQuery::create()->filterByAuthorId($author->getId())->findOneByBookNumber($book->getNumber());


            return $this->render('book', [
                'author' => $author->setLocale($app['current_locale']),
                'book' => $book,
                'commentary' => $commentary->setLocale($app['current_locale'])->getParsedDescription()
            ]);
        })
            ->convert('book', [BookQuery::class, 'findByCode']);

        $commentary->get(URLS::ALL['COMMENTARY_AUTHOR'], function (\Application $app, $slug) {
            $author = AuthorQuery::create()->useI18nQuery($app['current_locale'])->findOneBySlug($slug);

            return $this->render('author', [
                'author' => $author->setLocale($app['current_locale']),
            ]);
        });

        $commentary->get(URLS::ALL['COMMENTARY_AUTHOR_ALL'], function (\Application $app, $slug) {
            $commentaries = TraditionQuery::create()
                ->useAuthorQuery()
                    ->useI18nQuery($app['current_locale'])
                        ->filterBySlug($slug)
                     ->endUse()
                ->endUse()
                ->find();

            return $this->render('by_author', [
                'commentaries' => $commentaries,
            ]);
        });

        $commentary->get(URLS::ALL['COMMENTARY_AUTHORS'], function (\Application $app) {
            $authors = AuthorQuery::create()
                ->useYearQuery()
                    ->orderByDateFrom()
                ->endUse()
                ->find();

            return $this->render('authors', [
                'authors' => $authors,
            ]);
        });

        $commentary->get(URLS::ALL['COMMENTARY_CHAPTER'], function(\Application $app, Request $request, $authorSlug, Book $book, $chapterNum) {
            $verses = BibleQuery::create()
                ->findVersesOfChapter($book, $chapterNum);

            $marker = new $app['bible.marker']($chapterNum, $request->get('marker_group'));

            $author = AuthorQuery::create()
                ->useAuthorI18nQuery($app['current_locale'])
                    ->filterBySlug($authorSlug)
                ->endUse()
                ->findOne();

            $commentaries = TraditionQuery::create()
                ->filterByverseFrom($verses)
                ->filterByAuthor($author)
                ->find();

            return $this->render('chapter', [
                'verses' =>     $verses,
                'commentaries' => $commentaries,
                'request' =>    $request,
                'chaptersQTY'=> Bible::getChapters($app['bible_version'], $book)->count(),
                'bookCode'   => $book->getCode(),
                'marker'     => $marker,
                'author'     => $author->getTranslation($app['current_locale'])
            ]);
        })
            ->convert('book', [BookQuery::class, 'findByCode']);

        $commentary->get(URLS::ALL['COMMENTARY_VERSE'], function(\Application $app, Request $request, $authorSlug, $pointer) {
            $verse = BibleQuery::create()
                ->useVersionQuery()
                    ->filterByAbbreviation($app['bible_version'])
                ->endUse()
                ->findOneByPointer($pointer);

            $book = $verse->getBook();
            $chapterNum = $verse->getChapter();
            $marker = new $app['bible.marker']($chapterNum, $request->get('marker_group'));

            $author = AuthorQuery::create()
                ->useAuthorI18nQuery($app['current_locale'])
                ->filterBySlug($authorSlug)
                ->endUse()
                ->findOne();

            $commentary = TraditionQuery::create()
                ->filterByverseFrom($verse)
                ->useAuthorQuery()
                     ->useAuthorI18nQuery($app['current_locale'])
                         ->filterBySlug($authorSlug)
                     ->endUse()
                ->endUse()
                ->findOne();

            return $this->render('verse', [
                'verse' => $verse,
                'commentary' => $commentary,
                'request' => $request,

                'chaptersQTY'=> Bible::getChapters($app['bible_version'], $book)->count(),
                'bookCode'   => $book->getCode(),
                'marker'     => $marker,
                'author'     => $author->getTranslation($app['current_locale']),
                'versesQty'   => BibleQuery::create()->filterByBook($book)->filterByChapter($chapterNum)->filterByVersion(VersionQuery::create()->findByAbbreviation($app['bible_version']))->count(),
                'chapterNum'   => $chapterNum
            ]);
        });
    }
}