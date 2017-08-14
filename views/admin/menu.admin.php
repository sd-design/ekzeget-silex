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
| <a href="<?= $app->url(URLS::ALL['ADMIN_GALLERY']) ?>">медиа</a><br />

<ul id="tables_menu">
    Таблицы<span class="caret"></span>
    <?php
    $tablesStmt = \Propel\Runtime\Propel::getConnection()->prepare('SHOW TABLES');
    $tablesStmt->execute();

    foreach ($tablesStmt->fetchAll() as list($table)): ?>
        <li>
            <a href="<?= $app->url(URLS::ALL['ADMIN_TABLE'], ['table' => $table]) ?>">
                <?= $table ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<br />
