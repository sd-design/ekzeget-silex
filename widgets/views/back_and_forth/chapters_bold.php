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

/**
 * @var \models\interfaces\IMarker $marker
 */
extract($params);
?>
<table cellpadding="0" cellspacing="0" align=center border=0>
    <tr height="20" align=center>
        <td width=100 style="vertical-align: bottom;">
            <?php
            if ($back):?>
                <span class="ssil_uvelich">
           <?php
           if (isset($marker_group)) $back .= '?marker_group=' . $marker_group;
           ?>
                    <a href="<?= $back ?>"
                       style="font-size: 22px;<?= ($marker->isMarkedPrevChapter() ? 'color: #cc0000' : ''); ?>"
                       title="<?= $app['t']('prev_chapter') ?>">
                    <?= $app['t']('chapter') ?> <?= $current - 1 ?>
        </a>
    </span>
            <?php endif; ?>
        </td>
        <td>
            <h1><?= $app['t']('chapter') ?> <?=  $current ?></h1>
        <td width=100 style="vertical-align: bottom;">

            <?php
            if ($forth):
                if (isset($marker_group)) $forth .= '?marker_group=' . $marker_group;
                ?>
                <span class="ssil_uvelich">
        <a href="<?= $forth ?>"
           style="font-size: 22px;<?= ($marker->isMarkedNextChapter() ? 'color: #cc0000' : ''); ?>"
           title="<?= $app['t']('next_chapter') ?>">
            <?= $app['t']('chapter') ?> <?=  $current + 1 ?>
        </a></span>
            <?php endif; ?>
</table>