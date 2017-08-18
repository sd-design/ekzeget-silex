<?php
/**
 * @var \Application $app
 * @var \widgets\Widget $this
 * @var \models\Book[]|\Propel\Runtime\Collection\ObjectCollection $books
 * @var string $assets
 */
use services\URLS;
use models\Bible;

?>
<?php foreach ($books as $book):?>
    <li>
        <?php
        $url = $app->url(URLS::ALL['BIBLE_BOOK'], [
            'book' => $book->getCode()
        ]);
        $chapters = Bible::getChapters($app['bible_version'], $book)->count();
        ?>
        <a href="<?= $url ?>">
            <?=$book->getTranslation($app['current_locale'])->getMenuName()?>
        </a>
        <ul class="">
            <? $glav_i = 1;
            while($chapters>0){ ?>
            <li><a href="<?= $url ?><?= $glav_i ?>/"><?= $glav_i ?> глава</a></li>
   <? $glav_i++; $chapters=$chapters-1;} ?>
    </ul>
    </li>
<?php endforeach;?>