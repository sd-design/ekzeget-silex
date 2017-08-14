<?php
/**
 * @var \Application $app
 * @var \widgets\Widget $this
 * @var string $assets
 * @var \models\Bible[] $verses
 */
use services\URLS;

?>
<?php foreach ($verses as $verse): ?>
    <?php
    $bookCode = $verse->getBook()->getCode();
    $bookAbbr = $verse->getBook()->getTranslation($app['current_locale'])->getAbbreviation();

    $url = $app->url(URLS::ALL['BIBLE_BOOK_CHAPTER_VERSE'], [
        'book' => $bookCode,
        'chapterNum' => $verse->getChapter(),
        'verse' => $verse->getVerseNumber()
    ]);

    ?>
    <a href="<?= $url ?>">
        <?= $bookAbbr . '. ' . $verse->getChapter() . ':' . $verse->getVerseNumber() ?>
    </a>
    <br/>
<?php endforeach; ?>