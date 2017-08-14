<?php

namespace widgets;


use models\Bible;
use models\BibleQuery;
use models\VersionQuery;
use Propel\Runtime\Collection\ObjectCollection;
use Symfony\Component\HttpFoundation\Request;

class ParallelVerses extends Widget
{
    /* @var int  $fromVersePointer */
    protected $fromVersePointer;

    /* var int $toVersePointer */
    protected $toVersePointer;

    public function run()
    {
        $verses = BibleQuery::create()
            ->filterByPointer([
                'min' => $this->fromVersePointer,
                'max' => $this->toVersePointer
            ])
            ->filterByVersion(VersionQuery::create()->findByAbbreviation(get_app()['bible_version']))
            ->find();

        $parallelVerses = [];
        /* @var Bible $verse */
        foreach ($verses as $verse) {
            $parallelVerses[$verse->getVerseNumber()] = $verse->getParallelVerses();
        }

        if ($this->fromVersePointer < $this->toVersePointer) {
                return $this->render('parallel_verses/for_chapter', [
                'verses' => $parallelVerses,
            ]);
        }

        return $this->render('parallel_verses/for_verse', [
            'verses' => current($parallelVerses),
        ]);
    }
}
