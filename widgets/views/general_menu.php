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
use widgets\GeneralMenu;

?>
<div class="general_menu">
    <a href="<?=$base_url?>/sermon/" class="btn btn-default">Проповеди</a>
    <a href="<?=$base_url?>/dictionary/" class="btn btn-default">Словари</a> 
    <a href="<?=$base_url?>/maps/" class="btn btn-default">Карты</a> 
    <a href="<?=$base_url?>/tolks_all/" class="btn btn-default">Экзегеты</a> 
    <a href="<?=$base_url?>/lektorij/" class="btn btn-default">Лекторий</a> 
</div>