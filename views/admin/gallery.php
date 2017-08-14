<?php
/**
 * @var \Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 * @var Response $response
 * @var \Symfony\Component\Form\Form $form
 * @var string[] $images
 */
use Symfony\Component\HttpFoundation\Response;
?>
<?= $app['twig']->render('form.twig', array('form' => $form->createView())); ?>
<br />
<?php
foreach ($images as $image): ?>
    <img src="<?= $app['uploads.url'] . '/' . basename($image) ?>" width="200" />&nbsp;
<?php endforeach; ?>

