<?php
/**
 * @var \Application $app
 * @var Commentaries $this
 * @var \Propel\Runtime\Collection\Collection|\models\Tradition[] $commentaries
 * @var string $assets
 * @var boolean $isResearch
 * @var string $bookCode
 * @var integer $chapterNum
 */
use services\URLS;
use widgets\Commentaries;

?>
<div class="calendar_inside box1 text-center">
    <?php $modeId = $isResearch === Commentaries::MODE_COMMENTARY ? '1' : '5';?>
    <h3 id="open<?=$modeId?>_box">
        <a onclick="divOp<?=$modeId?>(1);"  class="btn btn-lg btn-primary">
            <?= $isResearch === Commentaries::MODE_COMMENTARY ? $app['t']('commentaries') : $app['t']('researches')?>
        </a>
    </h3>
    <div id="sort" style="position:absolute; margin: -11px 0 0 155px;">
        <a id="toggler_sort" href="javascript:void(0);" onclick="viewdiv('answer_sort');">
            <img src="<?= $assets ?>/img/sort.png" title="Сортировать"/>
        </a>
    </div>
    <div id="answer_sort" style="display:none;text-align:center">
        <div style="text-align:center">Выберите тип сортировки экзегетов:</div>
        <br/><label>
            <select name="sorty" id="sorty" onChange="" size=1>
                <option value="alfa" selected id="sortyselect">Алфавитный порядок</option>
                <option value="hrono" class="sortyselect">Хронологический порядок</option>
            </select>
    </div>
    <div id="open<?=$modeId?>" style="margin-top: -15px;padding:1px 5px;text-align:right">


        <a onclick="divOp<?=$modeId?>(1);">
            <img src="<?= $assets ?>/img/bottom.png" title="Раскрыть"/>
        </a>
    </div>
    <div id="blok_open<?=$modeId?>" style="display: none;">

        <?php
        foreach ($commentaries as $commentary):?>
            <?php $author = $commentary->getAuthor()->getTranslation($app['current_locale']); ?>
            <?php $url = $app->url(URLS::ALL['COMMENTARY_CHAPTER'], [
                    'authorSlug' => $author->getSlug(),
                    'book' => $bookCode,
                    'chapterNum' => $chapterNum
            ]); ?>
            <div class="tolk">
                <a href='<?= $url ?>'>
                    <?= $author->getName() ?>
                </a></div>
        <?php endforeach; ?>
    </div>
</div>

