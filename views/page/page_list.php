<?php
/**
 * @var \models\Page $page
 * @var \Silex\Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 */
 use services\URLS;
?>


<ul class="news">
<?php foreach($pages as $page):?>

    <li><a href="<?= $app->url(URLS::ALL['PAGE'], ['code' => $page->getCode()]);?>">
<?=$page->getTitle();?>
</a> (номер категрии <?=$page->getCategoryId();?>)
</li>
<?php endforeach;?>
</ul>