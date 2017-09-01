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


    <h2><a href="<?= $app->url(URLS::ALL['CATEGORY'], ['slug' => $cat->getSlug()]);?>">
<?=$cat->getTitle();?>
</a> (id категрии <?=$cat->getId();?>)
</h2>

</ul>