<?php
/**
 * @var \Application $app
 * @var \widgets\Widget $this
 * @var string $assets
 * @var \models\Bible[][] $verses
 */
use widgets\Widget;

?>
<div class="box" id="boxp">
    <h3 id="open3_box">
        <a onclick="divOp3(1);"><?= $app['t']('parallel_verses') ?></a>
    </h3>

    <div id="open3" style="margin-top: -15px;padding:1px 5px;text-align:right">
        <a onclick="divOp3(1);"><img src="<?= $assets ?>/img/bottom.png" title="Раскрыть"/></a></div>
    <div id="blok_open3" style="display: none;">
        <div id="para_aj">
            <?php
            $areVersesFound = false;
            ?>
            <?php foreach ($verses as $verseNum => $parallelVerses): ?>
                <?php if (!count($parallelVerses)) {
                    continue;
                }
                $areVersesFound = true;
                ?>
                <?php //$isMarked = ($arrMarked[$verseNum]) ? ' style="background: #F8FCBE; margin: 0 3px" ' : ''; ?>
                <div <?php /*echo  $isMarked */?>>
                <span id="parallel"><b><?= $verseNum ?></b><br/>
                    <span class="para">
                        <?= Widget::render('parallel_verses/list', ['verses' => $parallelVerses]) ?>
                    </span></span></div>
                <hr/>

                <?php endforeach?>

             <?php if (!$areVersesFound):?>
                 <div style="text-align: center; margin: 0 10px"><b><?= $app['t']('parallel_verses_not_found')?></b></div><br />
            <?php endif; ?>
            <br/>
        </div>
    </div>
</div>