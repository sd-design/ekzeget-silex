<?php
/**
 * @var \Application $app
 * @var \widgets\AuthorInfo $this
 * @var string $assets
 * @var string $audioUrl
 */
?>
<div id="audiobox">

    <br/>
    <div class="box" id="boxs">
        <h3 id="open2_box">
            <a onclick="divOp2(1);"><?= mb_strtoupper($app['t']('audio')) ?></a>
        </h3>
        <div id="open2" style="margin-top: -15px;padding:1px 5px;text-align:right">
            <a onclick="divOp2(1);"><img src="<?= $assets ?>/img/bottom.png" title="Раскрыть"/></a></div>
        <div id="blok_open2" style="display: none;padding:10px 3px 20px 3px;">
            <audio controls style="width: 99%" preload="none">
                <source src="<?php echo $audioUrl; ?>" type="audio/mpeg">
                <?= $app['t']('audio_tag_is_not_supported') ?></audio>
            <br/><br/>
            <div class="ssylki_st"><a href="<?php echo $audioUrl; ?>" download>Скачать</a></div>

        </div>
    </div>
</div>