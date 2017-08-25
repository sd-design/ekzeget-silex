<?php
/**
* @var \Silex\Application $app
* @var int $top
* @var string $text
* @var string $details
* @var \widgets\Widget $this
* @var string $assets
*/
?>
<div id="user_ip" style="position: absolute; top: <?=$top?>px; left: -20px; z-index: 100; display:block;
        border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5); padding: 15px;
        color: #311B0F; background: #FBFAE6;">
        <img src="<?=$assets?>/IMG/closed-red.png" id="closed-red"/>
    <?=$text?>
    <?php if(isset($details)):?>
        <div id="open" style="text-align:center">
            <a onclick="openip(1);"><?=$app['translator']->trans('more')?>...</a>
        </div>
        <div id="blok_open" style="display: none;">
            <?=$details?>
        </div>
    <?php endif;?>
</div>