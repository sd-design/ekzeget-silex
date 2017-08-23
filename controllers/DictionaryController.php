<?php

namespace controllers;


use models\DictionaryQuery;
use models\DictionaryWordQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Silex\ControllerCollection;

class DictionaryController extends Controller
{
    protected $layout = 'dictionary';

    protected function defineActions(ControllerCollection $dictionary)
    {

        $dictionary->get('/', function (\Application $app, $locale) {
            $app['page.title']= "Словари";
            return $this->render('index');
        })
            ->value('locale', get_app()['current_locale']);

        $dictionary->get('/list/{locale}', function (\Application $app, $locale) {
            $dictionaries = DictionaryQuery::create()->findByLocaleFrom($locale);
            return $this->render('list', [
                'dictionaries' => $dictionaries,
            ]);
        })
            ->value('locale', get_app()['current_locale']);

        $dictionary->get('/alphabet/{slug}', function (\Application $app, $slug) {

            $letters = DictionaryWordQuery::create()
                ->withColumn('SUBSTRING(word, 1, 1)', 'letter')
                ->addSelectModifier(Criteria::DISTINCT)
                ->select('letter')
                ->useDictionaryQuery()
                    ->filterBySlug($slug)
                ->endUse()
                ->find();

            return $this->render('alphabet', [
                'letters' => $letters,
            ]);
        });

        $dictionary->get('/{slug}/letter/{letter}/', function (\Application $app, $slug, $letter) {
            $words = DictionaryWordQuery::create()
                ->select(['id', 'word', 'variant'])
                ->useDictionaryQuery()
                    ->filterBySlug($slug)
                ->endUse()
                ->filterByWord($letter . '%', Criteria::LIKE)
                ->find();

            return $this->render('words', [
                'words' => $words,
            ]);
        });

        $dictionary->get('/{slug}/{word}/', function (\Application $app, $slug, $word) {
            $word = DictionaryWordQuery::create()
                ->useDictionaryQuery()
                    ->filterBySlug($slug)
                ->endUse()
                ->findOneByWord($word);

            return $this->render('word', [
                'word' => $word,
            ]);
        });
    }
}