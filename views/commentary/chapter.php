<?php
/**
 * @var \Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 * @var \Propel\Runtime\Collection\ObjectCollection|\models\Bible[] $verses
 * @var \Propel\Runtime\Collection\ObjectCollection|\models\Tradition[] $commentaries
 * @var Request $request
 * @var Response $response
 * @var int $chaptersQTY
 * @var string $bookCode
 * @var \models\interfaces\IMarker $marker
 * @var \models\AuthorI18n $author
 */
use services\URLS;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use widgets\Audio;
use widgets\BackAndForth;
use widgets\Commentaries;
use widgets\ParallelVerses;
use widgets\VersionChooser;

$size = 15;
$chapterNum = $verses->getFirst()->getChapter();
$this->setTitle($verses->getFirst()->getBook()->getTranslation($app['current_locale'])->getName());
?>


<!-- ФУНКЦИИ -->
<script defer type="text/javascript" src="<?=$assets?>/js/my/divOp1.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/increaseFontSize.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/disableBtn.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/ShowPopup.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/setup_mouse.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/SendRequestzak.1.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/toggler_z.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/SendperevodGlava.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/Sendmarkup.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/SendRequestzametka.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/toggler_sort.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/Sendsort.js"></script>

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

<style>
    p {font-size: <?php echo $size;?>px;}
</style>

<td><div style="width:610px;">
<table height="39" width="564" align="center" cellpadding="0" cellspacing="0" border="0" >
<tr>
<td style="width:200px">
    <?= VersionChooser::widget(['response' => $response, 'request' => $request]) ?>
</td>
<td width="170" height="39" align="center">

</td>
<td width="230"><div class='ssil_uvelich' style="float: left; margin: 5px 0 0 0;">
        <a style="font-family: Arial; text-decoration: none; font-weight: 900;font-size: 22px" href="javascript:decreaseFontSize(<?php echo $size;?>);" title="Уменьшить размер шрифта">A-</a>
        <a style="font-family: Arial; text-decoration: none; font-weight: 900;font-size: 22px" href="javascript:increaseFontSize(<?php echo $size;?>);" title="Увеличить размер шрифта">A+</a></div>
    <div id='icon'>
        <a href="javascript: popupURL = 'http://www.codex-sinaiticus.net/ru/manuscript.aspx?book=<?php echo $verses->getFirst()->getBook()->getManuscriptId().'&chapter='.$chapterNum;?>&lid=ru&side=r&zoomSlider=0'; ShowPopup(); "><img src="<?=$assets?>/img/svitok.png" title="Исследовать манускрипт" /></a>
        <?php
        /*
         * TODO
        if ($name_user) {
        $zam_ed_a = mysql_query("SELECT DISTINCT id, text FROM host1222968_pass.zametki WHERE kn LIKE '$kn' AND gl=$gl AND st='' AND user LIKE '$name_user'");
        $zam_ed = mysql_fetch_array($zam_ed_a);
        mysql_free_result($zam_ed_a);
        if ($zam_ed['id'])
            echo '<a class="toggler_z" ><span id="not"><img src="IMG/notes_yes.png" title="Редактировать заметку"/ ></span></a><div id="answer_z" class="answer_z" style="display: none;"><div id="an_zag"><img src="IMG/closed.png" class="closed" /><div id="zagol_okno1">Заметка на '.$kn_sokr.' '.$gl.' гл.</div><b id="status_zam"></b><br /> <TEXTAREA id="zamet" style="width: 285px; height: 260px; resize: none;">'.$zam_ed['text'].'</TEXTAREA><br /><br />    <button onclick="SendRequestzametka(\''.$kn.'\', \''.$gl.'\', \'\', \''.$name_user.'\');" disabled class="submit">Сохранить</button><img src="IMG/loading.gif" id="loading_z" /><br /><br /><a href="my_zametki.php">Все мои заметки</a></div ></div>';
        else
            echo '<a class="toggler_z" ><span id="not"><img src="IMG/notes.png" title="Добавить заметку"/ ></span></a><div id="answer_z" class="answer_z" style="display: none;"><div id="an_zag"><img src="IMG/closed.png" class="closed" /><div id="zagol_okno1">Заметка на '.$kn_sokr.' '.$gl.' гл.</div><b id="status_zam"></b><br /> <TEXTAREA id="zamet" style="width: 285px; height: 260px; resize: none;"></TEXTAREA><br /><br />    <button onclick="SendRequestzametka(\''.$kn.'\', \''.$gl.'\', \'\', \''.$name_user.'\');" disabled class="submit">Сохранить</button><img src="IMG/loading.gif" id="loading_z" /><br /><br /><a href="my_zametki.php">Все мои заметки</a></div></div >';

        $pr_zak = $kn_sokr.' '.$gl.' гл.';
        $pr_us = mysql_query("SELECT * FROM host1222968_pass.zakladki WHERE (red LIKE '$pr_zak' OR orange LIKE '$pr_zak' OR green LIKE '$pr_zak' OR blue LIKE '$pr_zak' OR fuchsia LIKE '$pr_zak') AND name LIKE '$name_user'");
        echo '<input id="color" type="hidden"><img style="width: 30px; margin: -5px -30px 0 0; " src="IMG/loading.gif" id="loading_zak" />';
        if (mysql_num_rows($pr_us)) echo '<!--';

        echo '<div style="width: 22px; float: right; margin: 0 0 0 4px; position: relative; " id="zak"><img style= "cursor: pointer;" src="IMG/zak.png" /><div class="some_block">Добавить закладку<br /><br />';?><a onclick="$('#color').attr('value', 'red'); SendRequestzak(<?php echo "'$pr_zak', '$tolk', '$name_user'"; ?>);"><img src="IMG/zak-red.png" /></a> &nbsp; <a onclick="$('#color').attr('value', 'orange'); SendRequestzak(<?php echo "'$pr_zak', '$tolk', '$name_user'"; ?>);"><img src="IMG/zak-orange.png" /></a> &nbsp; <a onclick="$('#color').attr('value', 'green'); SendRequestzak(<?php echo "'$pr_zak', '$tolk', '$name_user'"; ?>);"><img src="IMG/zak-green.png" /></a> &nbsp; <a onclick="$('#color').attr('value', 'blue'); SendRequestzak(<?php echo "'$pr_zak', '$tolk', '$name_user'"; ?>);"><img src="IMG/zak-blue.png" /></a> &nbsp; <a onclick="$('#color').attr('value', 'fuchsia'); SendRequestzak(<?php echo "'$pr_zak', '$tolk', '$name_user'"; ?>);"><?php echo '<img src="IMG/zak-fuchsia.png" /></a><br /><br />Внимание! При выборе уже существующей закладки, ее значение будет заменено на новое.</div></div>';
            if (mysql_num_rows($pr_us)) echo '-->';
            echo '<div style="width: 22px; float: right; margin: 0 0 0 4px; position: relative; " id="zak">';

            if ($f_zak['red'] == $pr_zak) echo '<a onclick="$(\'#color\').attr(\'value\', \'red\'); SendRequestzakdel();"><img src="IMG/zak-red.png" title="Удалить закладку" /></a>';
            if ($f_zak['orange'] == $pr_zak) echo '<a onclick="$(\'#color\').attr(\'value\', \'orange\'); SendRequestzakdel();"><img src="IMG/zak-orange.png" title="Удалить закладку" /></a>';
            if ($f_zak['green'] == $pr_zak) echo '<a onclick="$(\'#color\').attr(\'value\', \'green\'); SendRequestzakdel();"><img src="IMG/zak-green.png" title="Удалить закладку" /></a>';
            if ($f_zak['blue'] == $pr_zak) echo '<a onclick="$(\'#color\').attr(\'value\', \'blue\'); SendRequestzakdel();"><img src="IMG/zak-blue.png" title="Удалить закладку" /></a>';
            if ($f_zak['fuchsia'] == $pr_zak) echo '<a onclick="$(\'#color\').attr(\'value\', \'fuchsia\'); SendRequestzakdel();"><img src="IMG/zak-fuchsia.png" title="Удалить закладку" /></a>';
            echo '</div>';}*/
            ?>
    </div></td>
</tr>
</table>
<?= BackAndForth::widget([
    'template' => 'chapters_bold',
    'current' => $chapterNum,
    'total' => $chaptersQTY,
    'params' => [
        'marker' => $marker,
    ],
    'urlParams' => [
        'book' => $bookCode,
        'authorSlug' =>    $author->getSlug()
    ],
    'currentUrlParam' => 'chapterNum',
    'url' => URLS::ALL['COMMENTARY_CHAPTER']
]);?>




        <h2>
            <a href="<?=$app->url(URLS::ALL['COMMENTARY_AUTHOR_ALL'], ['slug' => $author->getSlug()])?>"><?= $author->getName() ?></a>
        <a href="<?=$app->url(URLS::ALL['COMMENTARY_AUTHOR'], ['slug' => $author->getSlug()])?>">
            <img src="/assets/img/info.png" title="<?=$app['t']('about_exeget')?>"/></a>

        </h2>


      <div id="osn_text">
          <p>
              <?php
              $verseNum = 0;
              $commentariesIndices = array_flip($commentaries->getColumnValues('endPointer'));
              foreach ($verses as $verse) {
                  $verseNum++;
                  if ($app['bible_version'] == 'grek') echo '<span class="grek"><b>';
                  if ($app['bible_version'] == 'csya_old') echo '<span class="irmologion"><b>';


                  $boldStyle = '';
                  if ($verse->isMarked()) {
                      $boldStyle = 'font-weight: bold; font-size:115%';
                  }
                  $url = $app->url(
                      URLS::ALL['BIBLE_BOOK_CHAPTER_VERSE'],
                      ['book' => $bookCode, 'chapterNum' => $chapterNum, 'verse' => $verseNum]
                  );

                  ?>
                  <a name="<?= $verseNum ?>"></a><sup><b><?= $verseNum ?></b></sup>
                  <a style="<?= $boldStyle ?>" href="<?= $url ?>">
                      <?= $verse->getContents() ?>
                  </a>
                  <?php if (isset($commentariesIndices[$verse->getPointer()])):?>
                      <p>
                        <?= $commentaries->get($commentariesIndices[$verse->getPointer()])->getTranslation($app['current_locale'])->getContents();?>
                      </p><br />
                  <?php endif;?>
              <?php
                  if (in_array($app['bible_version'], ['grek', 'csya_old'])) echo '</b></span>';
              }
              if ($verses->count() === 0) echo '<p style="color: red">Переувод на на данную главу отсутствует. Выберите другой.</p>';
              ?>
          </p></div>
        <?= BackAndForth::widget([
            'template' => 'arrows',
            'current' => $chapterNum,
            'total' => $chaptersQTY,
            'params' => [
                'marker' => $marker,
            ],
            'urlParams' => [
                'book' => $bookCode,
                'authorSlug' =>    $author->getSlug()
            ],
            'currentUrlParam' => 'chapterNum',
            'url' => URLS::ALL['COMMENTARY_CHAPTER']
        ]);?>
        </div>
</td>
<td style="width:200px">
    <?= Commentaries::widget(['fromVersePointer' => $verses->getFirst()->getPointer(), 'toVersePointer' => $verses->getLast()->getPointer(), 'bookCode' => $bookCode, 'chapterNum' => $chapterNum]); ?>
    <?= Commentaries::widget([
        'fromVersePointer' => $verses->getFirst()->getPointer(), 'toVersePointer' => $verses->getLast()->getPointer(), 'bookCode' => $bookCode, 'chapterNum' => $chapterNum, 'mode' => Commentaries::MODE_RESEARCH
    ]);
    ?>

    <?= ParallelVerses::widget(['fromVersePointer' => $verses->getFirst()->getPointer(), 'toVersePointer' => $verses->getLast()->getPointer()]) ?>

    <?= Audio::widget(['bookCode' => $bookCode, 'chapterNum' => $chapterNum, 'request' => $request])?>

    <br />

    <div align="center">

        <a href="http://orphus.ru" id="orphus" target="_blank"><img alt="Система Orphus" src="IMG/orphus.gif" border="0" width="125" height="115" /></a>
    </div>
    <br />
</td>
</tr>