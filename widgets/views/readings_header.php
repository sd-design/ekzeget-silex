<?php
/**
 * @var \Silex\Application $app
 * @var \widgets\Widget $this
 * @var string $dayAdverb
 * @var string $chosenMonthName
 * @var string $chosenYear
 * @var string $assets
 */
?>

<div style="width: 22px; float:right; margin: -5px 0 0 260px; cursor: pointer;position: absolute; "><a id="toggler"
                                                                                                       title="Перейти на любую дату чтения"><img
                src="<?=$assets?>/img/day.png"/ ></a>
    <div id="answer" style="display: none;">Введите дату богослужебных чтений:<br/> <input type="date" id="data_today"
                                                                                           maxlength="15"
                                                                                           pattern="\d+.+"
                                                                                           placeholder="гггг.мм.дд">
        <button type="submit" onclick="SendRequestPOST();" name="submit"
                style="padding: 6px 8px 5px 8px;font-size: 11px;">OK
        </button>
    </div>
</div>
<div id="chten_today"><b>
        <?= $dayAdverb ?>
        <span style="color: #DF0404; "><?= date('j') ?>, <?= $chosenMonthName ?></span>
        <?php if ($chosenYear != date('Y')): ?>
            <span style="color: green"> <?= $chosenYear ?> <?= $app['translator']->trans('year_abbr') ?></span>
        <?php endif; ?>
    </b></div>
