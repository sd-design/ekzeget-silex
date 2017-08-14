<?php
/**
 * @var \Application $app
 * @var \widgets\Widget $this
 * @var string $assets
 * @var Tradition[] $references
 */
use models\Tradition;
use services\URLS;

if (!count($references)) {return;}
?>
<br>
<div class="box" id="boxs">
    <h3 id="open4_box">

        <a onclick="divOp4(1);">НА СТИХ ССЫЛАЮТСЯ</a>
    </h3>
    <div id="open4" style="margin-top: -15px;padding:1px 5px;text-align:right">
        <a onclick="divOp4(1);"><img src="<?= $assets ?>/img/bottom.png" title="Раскрыть"/></a></div>
    <div id="blok_open4" style="display: none;">

        <div class="ssylki_st">
            <?php foreach ($references as $reference): ?>
                <?php
                $verse = $reference->getverseFrom();

                $url = $app->url(URLS::ALL['COMMENTARY_VERSE'], [
                    'authorSlug' => $reference->getAuthor()->getTranslation($app['current_locale'])->getSlug(),
                    'pointer' => $verse->getPointer()
                ]);
                ?>
                <b>
                    <?=
                    $verse->getBook()->getTranslation($app['current_locale'])->getAbbreviation()
                    ?>
                    <?= $verse->getChapter() ?>:<?= $verse->getVerseNumber() ?> &ndash;
                </b>
                <a href="<?= $url ?>"><?= $reference->getAuthor()->getTranslation($app['current_locale'])->getName() ?></a>
                <br/><br/>

            <?php endforeach; ?>
        </div>
    </div>
</div>
