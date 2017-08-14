<?php

namespace widgets;


use models\BibleQuery;
use models\TraditionQuery;
use Propel\Runtime\ActiveQuery\Criteria;

class ReferencesFromComments extends Widget
{
    /* @var int $versePointer */
    protected $versePointer;

    public function run()
    {
        $verse = BibleQuery::create()->findOneByPointer($this->versePointer);
        $verseRef = $verse->getBook()->getTranslation(get_app()['current_locale'])->getAbbreviation() . '. ' . $verse->getChapter() . ':' /*. $this->verse->getVerseNumber()*/;
        $verseRefsEncountered = TraditionQuery::create()
            ->useI18nQuery(get_app()['current_locale'])
            ->filterByContents('%{{{' . $verseRef . '%', Criteria::LIKE)
            ->endUse()
            ->find();

        $result = [];
        foreach ($verseRefsEncountered as $verseRefEncountered) {
            $matches = [];
            preg_match('/(?:\{{3})'.$verseRef.'(\d{1,3}[^}]*)(?:\}{3})/', $verseRefEncountered->getTranslation(get_app()['current_locale'])->getContents(), $matches);
            $matches[1] = str_replace('—', '-', $matches[1]);
            if (strpos($matches[1], '-')) {
                list($from, $to) = explode('-', $matches[1]);
                if (strpos($to, ',')) {
                    if (in_array($verse->getVerseNumber(), explode(',', $to))) {
                        $result[] = $verseRefEncountered;
                    }
                } elseif ($from <= $verse->getVerseNumber() && $to >= $verse->getVerseNumber()) {
                    $result[] = $verseRefEncountered;
                }
            } elseif (strpos($matches[1], ',')) {
                if (in_array($verse->getVerseNumber(), explode(',', $matches[1]))) {
                    $result[] = $verseRefEncountered;
                }
            } elseif ($matches[1] == $verse->getVerseNumber()) {
                $result[] = $verseRefEncountered;
            }
        }

        return $this->render('references_from_comments', ['references' => $result]);
    }
}