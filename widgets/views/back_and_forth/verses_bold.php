<?php
/**
 * @var \Application $app
 * @var \widgets\BackAndForth $this
 * @var string $assets
 * @var array $params
 * @var false|string $back
 * @var false|string $forth
 * @var integer $current
 */

?>
<table align=center border=0><tr align=center><td width=60 style="vertical-align: bottom;">
            <?php if ($back):?>
            <span class="ssil_uvelich">
                <a href="<?=$back?>"  accesskey ="x">Ст. <?= $current - 1 ?> </a></span>
            <?php endif; ?>

           </td><td><b id=st>Ст. <?= $current ?></b></td><td width=60 style="vertical-align: bottom;">

            <?php if($forth):?>
            <span class="ssil_uvelich">
                <a href="<?=$forth?>"  accesskey ="c">Ст. <?=$current + 1?> </a></span>
            <?php endif;?>
            </td></tr></table><br />