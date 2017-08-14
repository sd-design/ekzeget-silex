<?php
/**
 * @var \Silex\Application $app
 * @var \widgets\Widget $this
 * @var \models\News[]|\Propel\Runtime\Collection\ObjectCollection $news
 * @var string $assets
 */
?>
<div class="news-list">
<h3><?= mb_strtoupper($app['translator']->trans('news')) ?></h3>
<hr class="ekz">
                        <ul class="news">
    <?php foreach ($news as $pieceOfNews):?>
    <li>
            <h4>
                <?=strftime('%e %b. %Y', $pieceOfNews->getDate()->getTimestamp())?>
                <?= $app['translator']->trans('year_abbr') ?>
            </h4>
           <?=$pieceOfNews->getText()?>
        </li>
    <?php endforeach;?>
</ul>
</div>