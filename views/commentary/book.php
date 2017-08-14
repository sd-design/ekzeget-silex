<?php
/**
 * @var \Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 * @var string $commentary
 * @var \models\AuthorI18n $author
 * @var \models\Book $book
 */
use services\URLS;
use widgets\BookCommentariesList;

?>
<?php
$this->setTitle($author->getName()); ?>
<td>
    <div style="width:610px;">
        <table height="39" width="564" align="center" cellpadding="0" cellspacing="0" border="0">
            <tr>

                <td style="width:200px">
                </td>

                <td width="200" height="39" align="center">
                </td>
                <td style="width:200px">
                    <div class="ssil_uvelich" style="float: left; margin: 5px 0 0 0;"><a
                                style="font-family: Arial; text-decoration: none; font-weight: 900;font-size: 22px"
                                onclick="SendRequestssil_umensh();"
                                href="javascript:decreaseFontSize(<?php //echo $size;?>);"
                                title="Уменьшить размер шрифта">A-</a>
                        <a style="font-family: Arial; text-decoration: none; font-weight: 900;font-size: 22px"
                           onclick="SendRequestssil_uvelich();"
                           href="javascript:increaseFontSize(<?php //echo $size;?>);"
                           title="Увеличить размер шрифта">A+</a></div>


                    <?php
                    $this->setTitle($book->getTranslation($app['current_locale'])->getName());
                    ?>

                </td>
            </tr>
        </table>
        <br/>
        <h2><?= $author->getName() ?>
            <a href="<?=$app->url(URLS::ALL['COMMENTARY_AUTHOR'], ['slug' => $author->getSlug()])?>">
                <img src="/assets/img/info.png" title="<?=$app['t']('about_exeget')?>"/></a>

        </h2>
        <?php
        /*
                                $search_tolk = $_GET['search_tolk'] ?? null;
                                if ($search_tolk) {
                                    $search_tolk_all = explode (' ', $search_tolk);

                                    usort($search_tolk_all,  function ($a1, $a2) {
                                       return strlen($a1) <=> strlen($a2);
                                    });
                                    for ($y=0; $y<sizeof($search_tolk_all); $y++) {
                                        $tolk_s=preg_replace('/('.$search_tolk_all[$y].')/i', '<span style="background: #FFD800;">${1}</span>', $tolk_s);
                                    }
                                    $tolk_s=preg_replace('/(<a class="tooltip".+)<span style="background: #FFD800;">(.+)<\/span>/U', '${1}${2}', $tolk_s);
                                }*/
        ?>
        <p><?= $this->render('markup', ['txt' => $commentary]) ?></p><br/>
<td style="width:200px">
    <div class="box">
        <?= BookCommentariesList::widget(['book' => $book]) ?>
        <br/>
    </div>

    <br/>
</td>
</tr>
