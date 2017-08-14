<?php
/**
 * @var \Application $app
 * @var \widgets\Widget $this
 * @var string $assets
 * @var \models\Bible[] $verses
 */
use widgets\Widget;
if (!count($verses)) {return;}
?>

<div class="box" id="boxp">
    <h3 id="open3_box">
        <a onclick="divOp3(1);"><?= $app['t']('parallel_verses') ?></a>
    </h3>
    <div id="open3" style="margin-top: -15px;padding:1px 5px;text-align:right">


        <a onclick="divOp3(1);"><img src="http://ekzeget.dobroedelo.ru/IMG/bottom.png" title="Раскрыть"/></a></div>
    <div id="blok_open3" style="display: none;">

        <div id="parallel">

            <?= Widget::render('parallel_verses/list', ['verses' => $verses]) ?>
        </div>
        <br/></div></div>
