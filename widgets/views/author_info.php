<?php
/**
 * @var \Application $app
 * @var \widgets\AuthorInfo $this
 * @var string $assets
 * @var \models\Author $author
 */
use services\URLS;

?>
<h3><?= mb_strtoupper($app['t']('info')) ?></h3>
<div style="padding: 10px; color: #555; font-size: 14px">

    <?php if ($century = $author->getCentury()): ?>
        <?= $app['t']('lived_when') ?>: <span style="color:#222"> <?= $century ?> <?= $app['t']('century') ?>.</span>
        <br/><br/>
    <?php endif; ?>
    <?php if ($type = $author->getAuthorType()->setLocale($app['current_locale'])->getName()): ?>
        <?= $app['t']('belongs') ?>: <span style="color:#222"><?= $type ?></span><br/><br/>
    <?php endif; ?>
    <a href="<?= $app->url(URLS::ALL['COMMENTARY_AUTHOR_ALL'], ['slug' => $author->getTranslation($app['current_locale'])->getSlug()]) ?>">
        <?= $app['t']('all_commentaries') ?>
    </a>

    <br/>
    <br/>

</div>