<?php
/**
 * @var PDOCrud|string $page
 * @var PDOCrud|string $page_i18n
 * @var \Application $app
 * @var \services\ViewServiceProvider $this
 */


echo is_string($page) ? $page : $page->render();

if (isset($page_i18n)) {
    echo preg_replace('/<script.*?<\/script>/', '', is_string($page_i18n) ? $page_i18n : $page_i18n->render());
?>
<?php
}

echo (new PDOCrud())->loadPluginJsCode("ckeditor", "pdocrud-textarea");
?>