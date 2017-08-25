<?php
/**
 * @var \Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 * @var \Propel\Runtime\Collection\Collection|\models\Author[] $authors
 */
use services\URLS;
use widgets\News;

?>

    <div>
        <br/>
        <span style='color: #797979; margin-left: 15px; font-weight: 900;'>
        <?= $app['t']('all_exegets') ?>
    </span>
        <hr/>
        <?php
        $this->setTitle($app['t']('exegets'));
        ?>
        <ul class=pravila>
            <?php foreach ($authors as $author): ?>
                <?php $author->setLocale($app['current_locale']);?>
                <li>
                    <a style="font-size: 18px;" href="<?= $app->url(URLS::ALL['COMMENTARY_AUTHOR_ALL'], ['slug' => $author->getSlug()]) ?>">
                        <?= $author->getName() ?>
                    </a>
                    <a href="<?= $app->url(URLS::ALL['COMMENTARY_AUTHOR'], ['slug' => $author->getSlug()]) ?>">
                        <img src="<?= $assets ?>/img/info.png" title="<?= $app['t']('about_exeget') ?>"/>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>