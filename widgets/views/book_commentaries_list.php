<?php
/**
 * @var \Application $app
 * @var \widgets\Widget $this
 * @var string $bookAbbr
 * @var \models\Book[]|\Propel\Runtime\Collection\ObjectCollection $commentaries
 * @var string $assets
 */
use services\URLS;

?>
<h3><?=$app['t']('about_book')?></h3>
<?php
foreach ($commentaries as $commentary):?>
    <div class="tolk">
        <?php
        $url = $app->url(URLS::ALL['COMMENTARY_BOOK'], [
            'book' => $bookAbbr,
            'authorSlug' => $commentary->getAuthor()->getTranslation($app['current_locale'])->getSlug()
        ]);
        ?>
        <a href="<?= $url ?>">
            <?=$commentary->getAuthor()->setLocale($app['current_locale'])->getName()?>
        </a>
    </div>
<?php endforeach;?>