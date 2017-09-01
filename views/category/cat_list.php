<?php
/**
 * @var \models\Category $cat
 * @var \Silex\Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 */
 use services\URLS;
?>


<ul class="news">
<?php foreach($cats as $cat):?>

    <li><a href="<?= $app->url(URLS::ALL['CATEGORY'], ['slug' => $cat->getSlug()]);?>">
<?=$cat->getTitle();?>
</a> (номер категрии <?=$cat->getId();?>)
</li>
<?php endforeach;?>
</ul>