<?php

namespace widgets;

use models\TraditionQuery;

class Commentaries extends Widget
{
    const MODE_COMMENTARY = false;
    const MODE_RESEARCH = true;

    /* @var int  $fromVersePointer */
    protected $fromVersePointer;

    /* var int $toVersePointer */
    protected $toVersePointer;

    /* @var string $bookCode */
    protected $bookCode;

    /* @var int $chapterNum */
    protected $chapterNum;

    protected $isResearch = self::MODE_COMMENTARY;

    public function run()
    {
        $commentaries = TraditionQuery::create()
            ->useAuthorQuery()
                ->filterByIsResearch($this->isResearch)
                ->useAuthorI18nQuery(get_app()['current_locale'])
                    ->withColumn('name', 'author_name')
                    ->withColumn('slug', 'author_slug')
                ->endUse()
            ->endUse()
            ->filterByStartPointer([
                'min' => $this->fromVersePointer,
                'max' => $this->toVersePointer
            ])
            ->groupByAuthorId()
            ->find();

        return $this->render('commentaries', [
            'commentaries' => $commentaries,
            'isResearch' => $this->isResearch,
            'bookCode'   => $this->bookCode,
            'chapterNum'   => $this->chapterNum,
        ]);
    }
}