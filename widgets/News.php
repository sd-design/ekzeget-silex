<?php
namespace widgets;


use models\NewsQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class News extends Widget
{

    public function run()
    {
        $news = NewsQuery::create()
            ->filterByLocale(get_app()['current_locale'])
            ->orderByDate(Criteria::DESC)
            ->limit(10)
            ->find();

        return $this->render('news', [
            'news' => $news
        ]);
    }
}