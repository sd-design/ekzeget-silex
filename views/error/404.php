<?php
/**
 * @var \Silex\Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 * @var \Symfony\Component\HttpFoundation\Response $response
 */
?>
<?php $this->setTitle($app['t']('page_is_NOT_found'))?>

    <div style="text-align: center;font-size: 140px;font-weight: 900;color: #D6E6E4;">404</div>
    <div style="text-align: center;font-size: 20px; margin-top: -70px; color: #444; margin-left: 250px">Not Found</div>
    <div style="text-align: center; color: red;margin-left: -100px; margin-top: 20px"><?=$app['t']('sorry_PAGE_is_not_found');?></div>
        <div class="box">
            <?= \widgets\News::widget()?>
        </div>
 