<?php

namespace controllers;


use models\EventBibleQuery;
use models\EventQuery;
use models\SermonQuery;
use Silex\ControllerCollection;

class SermonController extends Controller
{

    protected function defineActions(ControllerCollection $sermon)
    {
        $sermon->get('/events/', function (\Application $app) {
            $events = EventQuery::create()
                ->useI18nQuery($app['current_locale'])
                ->endUse()
                ->find();

            return $this->render('events', [
                'events' => $events,
            ]);
        });

        $sermon->get('/topics/', function (\Application $app) {
            $sermons = SermonQuery::create()
                ->select('topic')
                ->groupByTopic()
                ->find();

            return $this->render('topics', [
                'topics' => $sermons,
            ]);
        });

        $sermon->get('/{event}/', function (\Application $app, $event) {
            $sermons = SermonQuery::create()
                ->select(['id', 'topic'])
                ->filterByEventId($event)
                ->useAuthorQuery()
                    ->useAuthorI18nQuery($app['current_locale'])
                        ->withColumn('name', 'author_name')
                        ->withColumn('slug', 'author_slug')
                    ->endUse()
                ->endUse()
                ->find();

            return $this->render('event_sermons', [
                'sermons' => $sermons,
                'pointers'  =>  EventBibleQuery::create()->findByEventId($event)
            ]);
        });

        $sermon->get('/{event}/author/{author}/', function ($event, $author) {
            $sermons = SermonQuery::create()
                ->filterByEventId($event)
                ->useAuthorQuery()
                    ->useAuthorI18nQuery()
                        ->filterBySlug($author)
                    ->endUse()
                ->endUse()
                ->find();

            return $this->render('event_author_sermons', [
                'sermons' => $sermons,
            ]);
        });

        $sermon->get('/{event}/{sermon}/', function ($event, $sermon) {
            $sermon = SermonQuery::create()
                ->findOneById($sermon);

            return $this->render('event_author_sermon', [
                'sermon' => $sermon,
                'pointers'  =>  EventBibleQuery::create()->findByEventId($event)
            ]);
        });
    }
}