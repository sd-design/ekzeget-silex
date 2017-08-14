<?php
/**
 * @var \Propel\Runtime\Collection\ObjectCollection $verses
 * @var \models\interfaces\IMarker $marker
 * @var \Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 * @var Request $request
 * @var Response $response
 * @var int $chapterNum
 * @var string $bookCode
 * @var Book $book
 * @var int $chaptersQTY
 * @var array $commentedVerses
 */

use models\Book;
use services\URLS;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use widgets\Audio;
use widgets\BackAndForth;
use widgets\Commentaries;
use widgets\ParallelVerses;
use widgets\VersionChooser;


$size = 15;

$marker_st = $request->get('marker_st');
$marker_group = $request->get('marker_group');

$this->setTitle($book->setLocale($app['current_locale'])->getName());

if (empty($name_user)) $name_user=$_SESSION['name_user'] ?? null;
//------------------------------------------------------------------------------------------------------------------
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


<div id="popUpBox">Сгенерировать ссылку</div><div id="favorite"><img src="<?=$assets?>/img/favorite.png" /></div>
<?php
// TODO generate link and add to favourite for selected verses
?>


<td><div style="width:610px;">

        <table height="39" width="564" align="center" cellpadding="0" cellspacing="0" border="0" >
            <tr>
                <td style="width:200px">
                    <div id="spis_per">
                        <?= VersionChooser::widget(['response' => $response, 'request' => $request]) ?>
                    </div>
                </td>
                <td width="170" height="39" align="center">

                </td>
                <td width="230"><div class='ssil_uvelich' style="float: left; margin: 5px 0 0 0;"><a style="font-family: Arial; text-decoration: none; font-weight: 900;font-size: 22px" href="javascript:decreaseFontSize(<?php echo $size;?>);" title="Уменьшить размер шрифта">A-</a>
                        <a style="font-family: Arial; text-decoration: none; font-weight: 900;font-size: 22px" href="javascript:increaseFontSize(<?php echo $size;?>);" title="Увеличить размер шрифта">A+</a></div>
                    <div id='icon'>
                        <a onclick=""><img src="<?=$assets?>/img/markup.png" title="Изменить расположение текста" /></a>
                        <a href="javascript: popupURL = 'http://www.codex-sinaiticus.net/ru/manuscript.aspx?book=<?php echo $verses->getFirst()->getBook()->getManuscriptId().'&chapter='.$chapterNum;?>&lid=ru&side=r&zoomSlider=0'; ShowPopup(); "><img src="<?=$assets?>/img/svitok.png" title="Исследовать манускрипт" /></a>
                        <a href="glava_stolb.php?kn=<?php echo $bookCode.'&chapterNum='.$chapterNum;?>" title="Все переводы столбцами"><img src="<?=$assets?>/img//columns.png" /></a>
                        <?php
                        /*
                         * TODO
                         * if ($name_user) {
                        $zam_ed_a = mysqli_query($connect, "SELECT DISTINCT id, text FROM host1222968_pass.zametki WHERE bookCode LIKE '$bookCode' AND chapterNum=$chapterNum AND st='' AND user LIKE '$name_user'");
                        $zam_ed = mysqli_fetch_array($zam_ed_a);
                        mysqli_free_result($zam_ed_a);
                        if ($zam_ed['id'])
                            echo '<a class="toggler_z" ><span id="not"><img src="IMG/notes_yes.png" title="Редактировать заметку"/ ></span></a><div id="answer_z" class="answer_z" style="display: none;"><div id="an_zag"><img src="IMG/closed.png" class="closed" /><div id="zagol_okno1">Заметка на '.$kn_sokr.' '.$chapterNum.' гл.</div><b id="status_zam"></b><br /> <TEXTAREA id="zamet" style="width: 285px; height: 260px; resize: none;">'.$zam_ed['text'].'</TEXTAREA><br /><br />    <button onclick="SendRequestzametka(\''.$bookCode.'\', \''.$chapterNum.'\', \'\', \''.$name_user.'\');" disabled class="submit">Сохранить</button><img src="IMG/loading.gif" id="loading_z" /><br /><br /><a href="my_zametki.php">Все мои заметки</a></div ></div>';
                        else
                            echo '<a class="toggler_z" ><span id="not"><img src="IMG/notes.png" title="Добавить заметку"/ ></span></a><div id="answer_z" class="answer_z" style="display: none;"><div id="an_zag"><img src="IMG/closed.png" class="closed" /><div id="zagol_okno1">Заметка на '.$kn_sokr.' '.$chapterNum.' гл.</div><b id="status_zam"></b><br /> <TEXTAREA id="zamet" style="width: 285px; height: 260px; resize: none;"></TEXTAREA><br /><br />    <button onclick="SendRequestzametka(\''.$bookCode.'\', \''.$chapterNum.'\', \'\', \''.$name_user.'\');" disabled class="submit">Сохранить</button><img src="IMG/loading.gif" id="loading_z" /><br /><br /><a href="my_zametki.php">Все мои заметки</a></div></div >';

                        $pr_zak = $kn_sokr.' '.$chapterNum.' гл.';
                        $pr_us = mysqli_query($connect, "SELECT * FROM host1222968_pass.zakladki WHERE (red LIKE '$pr_zak' OR orange LIKE '$pr_zak' OR green LIKE '$pr_zak' OR blue LIKE '$pr_zak' OR fuchsia LIKE '$pr_zak') AND name LIKE '$name_user'");
                        echo '<input id="color" type="hidden"><img style="width: 30px; margin: -5px -30px 0 0; " src="IMG/loading.gif" id="loading_zak" />';
                        if (mysqli_num_rows($pr_us)) echo '<!--';

                        echo '<div style="width: 22px; float: right; margin: 0 0 0 4px; position: relative; " id="zak"><img style= "cursor: pointer;" src="IMG/zak.png" /><div class="some_block">Добавить закладку<br /><br />';?><a onclick="$('#color').attr('value', 'red'); SendRequestzak(<?php echo "'$pr_zak', '$tolk', '$name_user'"; ?>);"><img src="IMG/zak-red.png" /></a> &nbsp; <a onclick="$('#color').attr('value', 'orange'); SendRequestzak(<?php echo "'$pr_zak', '$tolk', '$name_user'"; ?>);"><img src="IMG/zak-orange.png" /></a> &nbsp; <a onclick="$('#color').attr('value', 'green'); SendRequestzak(<?php echo "'$pr_zak', '$tolk', '$name_user'"; ?>);"><img src="IMG/zak-green.png" /></a> &nbsp; <a onclick="$('#color').attr('value', 'blue'); SendRequestzak(<?php echo "'$pr_zak', '$tolk', '$name_user'"; ?>);"><img src="IMG/zak-blue.png" /></a> &nbsp; <a onclick="$('#color').attr('value', 'fuchsia'); SendRequestzak(<?php echo "'$pr_zak', '$tolk', '$name_user'"; ?>);"><?php echo '<img src="IMG/zak-fuchsia.png" /></a><br /><br />Внимание! При выборе уже существующей закладки, ее значение будет заменено на новое.</div></div>';
                            if (mysqli_num_rows($pr_us)) echo '-->';
                            echo '<div style="width: 22px; float: right; margin: 0 0 0 4px; position: relative; " id="zak">';

                            if ($f_zak['red'] == $pr_zak) echo '<a onclick="$(\'#color\').attr(\'value\', \'red\'); SendRequestzakdel(\''.$pr_zak.'\', \''.$tolk.'\', \''.$name_user.'\');"><img src="IMG/zak-red.png" title="Удалить закладку" /></a>';
                            if ($f_zak['orange'] == $pr_zak) echo '<a onclick="$(\'#color\').attr(\'value\', \'orange\'); SendRequestzakdel(\''.$pr_zak.'\', \''.$tolk.'\', \''.$name_user.'\');"><img src="IMG/zak-orange.png" title="Удалить закладку" /></a>';
                            if ($f_zak['green'] == $pr_zak) echo '<a onclick="$(\'#color\').attr(\'value\', \'green\'); SendRequestzakdel(\''.$pr_zak.'\', \''.$tolk.'\', \''.$name_user.'\');"><img src="IMG/zak-green.png" title="Удалить закладку" /></a>';
                            if ($f_zak['blue'] == $pr_zak) echo '<a onclick="$(\'#color\').attr(\'value\', \'blue\'); SendRequestzakdel(\''.$pr_zak.'\', \''.$tolk.'\', \''.$name_user.'\');"><img src="IMG/zak-blue.png" title="Удалить закладку" /></a>';
                            if ($f_zak['fuchsia'] == $pr_zak) echo '<a onclick="$(\'#color\').attr(\'value\', \'fuchsia\'); SendRequestzakdel(\''.$pr_zak.'\', \''.$tolk.'\', \''.$name_user.'\');"><img src="IMG/zak-fuchsia.png" title="Удалить закладку" /></a>';
                            echo '</div>';}*/
                        ?>
                    </div></td>
            </tr>
        </table>

        <span class="glav">
                    <?= BackAndForth::widget([
                        'template' => 'chapters_bold',
                        'current' => $chapterNum,
                        'total' => $chaptersQTY,
                        'params' => [
                            'marker' => $marker,
                        ],
                        'urlParams' => [
                            'book' => $bookCode,
                        ],
                        'currentUrlParam' => 'chapterNum',
                        'url' => URLS::ALL['BIBLE_BOOK_CHAPTER']
                    ])?>
            <br /><div id="osn_text"><p>
 <?php
 ################################
 /* TODO
 $favorite = mysqli_query($connect, "SELECT * FROM host1222968_pass.favorite WHERE bookCode LIKE '$bookCode' AND chapterNum LIKE '$chapterNum' AND name_user LIKE '$name_user'");
 $num_fav = mysqli_num_rows($favorite);
 for ($f=0; $f<$num_fav; $f++)
 {
     $fav_stih = mysqli_fetch_array($favorite);
     $mas_fav[$f] = preg_split("/\s/", $fav_stih['st']);
     $color_fav[$f] = $fav_stih['color'];
 }
 */
 ################################
 $verseNum = 0;
 foreach ($verses as $verse) {
     $verseNum++;
     /* TODO
     if ($num_fav > 0) {
         for ($f=0; $f < $num_fav; $f++) {
             if (in_array($verseNum, $mas_fav[$f])) {
                 echo '<span style="background:'.$color_fav[$f].'">';
             }
         }
     }
     */
     if ($app['bible_version'] == 'grek') echo '<span class="grek"><b>';
     if ($app['bible_version'] == 'csya_old') echo '<span class="irmologion"><b>';

     $hasVerseComment = isset($commentedVerses[$verse->getPointer()]);
     $hasVerseCommentTxt = $hasVerseComment ? 'Толкование на стих имеется' : 'Толкование на стих отсутствует';
     $hasVerseCommentColour = $hasVerseComment ? '#222;' : '#777;';
     $boldStyle = '';
     if ($verse->isMarked()) {
         $boldStyle = 'font-weight: bold; font-size:115%';
     }
     $url = $app->url(
         URLS::ALL['BIBLE_BOOK_CHAPTER_VERSE'],
         ['book' => $bookCode, 'chapterNum' => $chapterNum, 'verse' => $verseNum]
     );

     ?>
     <a name="<?=$verseNum?>"></a><sup><b><?=$verseNum?></b></sup>
     <a style="color:<?=$hasVerseCommentColour?><?=$boldStyle?>" href="<?=$url?>" title="<?=$hasVerseCommentTxt?>">
        <?=$verse->getContents()?>
    </a>
     <?php
     if (in_array($app['bible_version'], ['grek','csya_old'])) echo '</b></span>';

     /* TODO
 if ($num_fav > 0) {
     for ($f=0; $f<$num_fav; $f++)
     {
         if (in_array ($verseNum , $mas_fav[$f]))
         {
             echo '</span>';
         }
     }
 }*/
 }

 if ($verses->count() === 0) echo '<p style="color: red">Перевод на на данную главу отсутствует. Выберите другой.</p>';
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
                ],
                'currentUrlParam' => 'chapterNum',
                'url' => URLS::ALL['BIBLE_BOOK_CHAPTER']
            ])?>
</span>
        <br /><br />
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
<?php
        /* TODO $favorite = mysqli_query($connect, "SELECT * FROM host1222968_pass.favorite WHERE bookCode LIKE '$bookCode' AND chapterNum LIKE '$chapterNum' AND name_user LIKE '$name_user' ORDER by st + 0");

         if ($num_fav > 0) {
             echo '<div class="ssylki_st">';
             for ($fff=0; $fff<$num_fav; $fff++)
             {
                 $fav_st = mysqli_fetch_array($favorite);
                 if (preg_match_all ("/\d+\s\d+/", $fav_st['st'], $masfa)) {
                     preg_match_all ("/^\D*(\d+)/", $fav_st['st'], $perv);
                     preg_match_all ("/(\d+)\D*$/", $fav_st['st'], $posl);
                     $stt=$perv[1][0].'-'.$posl[1][0];
                     $diez = $perv[1][0];
                     echo '<span style="background:'.$fav_st['color'].'">&#160;<a title="Перейти к избранным стихам" style="color:#222" href="#'.$diez.'">стт. '.$stt.'</a>&#160;</span> - ';}
                 else {
                     $diez = $fav_st['st'];
                     echo '<span style="background:'.$fav_st['color'].'">&#160;<a title="Перейти к избранному стиху" style="color:#222" href="#'.$diez.'">ст. '.$fav_st['st'].'</a>&#160;</span> - ';
                 }
                 $tags = preg_split("/,/", $fav_st['tags']);
                 $tags=preg_replace ('/^\s/', '', $tags);
                 $tags=preg_replace ('/\s$/', '', $tags);

                 for ($j=0; $j<count($tags); $j++)
                 {
                     if ($j==0) $tag = '<a title="Посмотреть все избранные стихи с этим тегом" style="color:#666" href="my_favorite.php?search_tag='.$tags[$j].'">'.$tags[$j].'</a>';
                     else $tag = $tag.'<span style="color:#666">,</span> <a title="Посмотреть все избранные стихи с этим тегом" style="color:#666" href="my_favorite.php?search_tag='.$tags[$j].'">'.$tags[$j].'</a>';
                 }
                 echo $tag.' <span class="del_fav"><a href="favorite_edit.php?id='.$fav_st['id'].'&diez='.$diez.'">Редактировать</a></span><br /><br />';
                 unset($tag);

             }
             echo '</div>';
         }*/
        ?>
        <div align="center">

            <a href="http://orphus.ru" id="orphus" target="_blank"><img alt="Система Orphus" src="IMG/orphus.gif" border="0" width="125" height="115" /></a>
        </div>
        <br />
</td>
</tr>