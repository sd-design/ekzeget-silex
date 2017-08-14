<?php
/**
 * @var \Application $app
 * @var \widgets\Widget $this
 * @var \models\Book[]|\Propel\Runtime\Collection\ObjectCollection $books
 * @var string $assets
 */
use services\URLS;

?>
<?php foreach ($books as $book):?>
    <li>
        <?php
        $url = $app->url(URLS::ALL['BIBLE_BOOK'], [
            'book' => $book->getCode()
        ]);
        ?>
        <a href="<?= $url ?>">
            <?=$book->getTranslation($app['current_locale'])->getMenuName()?>
        </a>
        <ul><li><a href="<?= $url ?>1/">1 глава</a></li></ul>
    </li>
<?php endforeach;?>