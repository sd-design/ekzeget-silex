<?php
/**
 * @var \models\Page $page
 * @var \Silex\Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 */
?>

<?php $this->setTitle($page->getTitle())?>
<?=$page->getText()?>