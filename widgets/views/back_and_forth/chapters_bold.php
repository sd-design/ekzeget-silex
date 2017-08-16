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
<hr/>
<div class="row glav">
    <div class="col-sm-4">
        <?php
        if ($back):?>
            <span class="ssil_uvelich">
       <?php
       if (isset($marker_group)) $back .= '?marker_group=' . $marker_group;
       ?>
                <a class="next" href="<?= $back ?>"
                   style="<?= ($marker->isMarkedPrevChapter() ? 'color: #cc0000' : ''); ?>"
                   title="<?= $app['t']('prev_chapter') ?>">
                   << <span><?= $app['t']('chapter') ?> <?= $current - 1 ?></span> 
        </a>
        </span>
        <?php endif; ?>
    </div>
    <div class="col-sm-4">
        <h1><?= $app['t']('chapter') ?> <?=  $current ?></h1>
    </div>
    <div class="col-sm-4">
        <?php
        if ($forth):
            if (isset($marker_group)) $forth .= '?marker_group=' . $marker_group;
            ?>

    <a class="next" href="<?= $forth ?>"
       style="<?= ($marker->isMarkedNextChapter() ? 'color: #cc0000' : ''); ?>"
       title="<?= $app['t']('next_chapter') ?>"> <span>
        <?= $app['t']('chapter') ?> <?=  $current + 1 ?></span> >>
    </a>
        <?php endif; ?>
    </div>
</div>
<hr />