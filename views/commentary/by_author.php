<?php
/**
 * @var \Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 * @var \Propel\Runtime\Collection\Collection|\models\Tradition[] $commentaries
 */
use services\URLS;
use widgets\News;

?>

<td><div style="width:610px;">
        <p><?= $app['t']('total_commentaries')?>: <b> <?= $commentaries->count() ?> </b></p>

            <br />

        <?php
        $author = $commentaries->getFirst()->getAuthor();
        $authorName = $author->getTranslation($app['current_locale'])->getName();
        $authorSlug = $author->getTranslation($app['current_locale'])->getSlug();

        $this->setTitle($authorName);
        ?>
        <?php foreach ($commentaries as $commentary):?>
            <p>
                <b><span style="color:#CA1D06; font-family: Georgia; ">
                    <?= $commentary->getverseFrom()->getBook()->getTranslation($app['current_locale'])->getAbbreviation() ?>.
                    <?= $commentary->getverseFrom()->getChapter() ?>:<?= $commentary->getverseFrom()->getVerseNumber() ?>
                </span></b>
                <?php $url = $app->url(URLS::ALL['COMMENTARY_VERSE'], [
                    'authorSlug' => $authorSlug,
                    'pointer' => $commentary->getStartPointer()
                ]); ?>
                <a href="<?= $url ?>"> <?= $authorName ?> </a><br />
            </p>
        <?php endforeach;?>
    </div>
</td>
<td>
    <div class="box">
        <?= News::widget() ?>
    </div>
</td>
<tr>