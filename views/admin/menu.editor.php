<?php
/**
 * @var \Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 * @var Response $response
 */
use services\URLS;
use Symfony\Component\HttpFoundation\Response;

?>

Добавить: <a href="<?= $app->url(URLS::ALL['ADMIN_COMMENTARY_ADD']) ?>">комментарий</a>
    | <a href="<?= $app->url(URLS::ALL['ADMIN_AUTHOR_ADD']) ?>">автора/произведение</a>
    | <a href="<?= $app->url(URLS::ALL['ADMIN_COMMENTARY_BOOK_ADD']) ?>">комментарий на книгу</a>
