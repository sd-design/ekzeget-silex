<?php
/**
 * @var ObjectCollection $verse
 * @var \models\interfaces\IMarker $marker
 * @var \Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 * @var Request $request
 * @var Response $response
 * @var int $chapterNum
 * @var string $bookCode
 * @var Book $book
BIBLE_BOOK_CHAPTER_VERSE
 */

use Propel\Runtime\Collection\ObjectCollection;
use services\URLS;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use widgets\BackAndForth;
use widgets\Commentaries;
use widgets\ParallelVerses;
use widgets\ReferencesFromComments;
use widgets\VersionChooser;
use models\Book;

require '/var/www/ekzeget.ru/public_html/FILES/function_php.php';

$kn = 'mf';

$gl = 10;
$st = 1;

$sorty = $request->cookies->get('sorty', 'alfa');
$open_tolk = $request->cookies->get('open_tolk', 'off');

$open_issled = $request->cookies->get('open_issled', 'off');

$open_prop = $request->cookies->get('open_prop', 'off');
$open_ssil = $request->cookies->get('open_ssil', 'off');

$kn_gl= $kn.$gl;
$tolk = '';
$name_user = '';

$this->setTitle($book->setLocale($app['current_locale'])->getName());

/////// СОЗДАЕМ МАССИВ ВСЕХ ЯЧЕЕК СТИХА------------------------------------------------------------------
$connect = mysqli_connect("127.0.0.1", "ekzeget2", "Xr0KJ3jsyNzyAYWGRLC1");

$kn_sokr = 'Мф';
?>
<!--ФУНКЦИИ -->
<script defer type="text/javascript" src="<?=$assets?>/js/my/divOp1.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/SendRequestzak.1.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/ShowPopup.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/disableBtn.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/toggler_z.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/SendRequestzametka.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/setup_mouse.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/toggler_sort.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/Sendsort.js"></script>
<script defer type="text/javascript" src="http://ekzeget.dobroedelo.ru/js/my/SendperevodSTIH.js"></script>



        <td><div style="width:610px;">
                <table height="39" width="564" align="center" cellpadding="0" cellspacing="0" border="0" >

                    <tr>
                        <td style="width:200px">
                            <div id="spis_per">
                                <?= VersionChooser::widget(['response' => $response, 'request' => $request]) ?>
                            </div>
                        </td>
                        <td width="200" height="39" align="center">

                        </td>
                        <td style="width:200px">
                            <div id='icon'>

                                <a href="javascript: popupURL = 'http://www.codex-sinaiticus.net/ru/manuscript.aspx?book=<?php echo $verse->getFirst()->getBook()->getManuscriptId().'&chapter='.$chapterNum;?>&lid=ru&side=r&zoomSlider=0'; ShowPopup(); "><img src="<?=$assets?>/img/svitok.png" title="Исследовать манускрипт" /></a>
                            </div></td></tr></table>
                                <?php
/*TODO
                                if (isset($auth) && $auth == '1') echo '<a href="edit_tolk.php?kn='.$kn.'&gl='.$gl.'&st='.$st.'&tolk='.$tolk.'"><img src="IMG/edit.png" title="Редактировать толкование" /></a> ';
                                else
                                    echo '<a href="add.php?kn='.$kn.'&gl='.$gl.'&st='.$st.'"><img src="IMG/add.png" title="Добавить толкование" /></a> ';
                                $favorite = mysqli_query($connect, "SELECT id, tags, st FROM host1222968_pass.favorite WHERE kn LIKE '$kn' AND gl LIKE '$gl' AND name_user LIKE '$name_user' AND (st REGEXP ' $st ' OR st REGEXP ' $st$' OR st REGEXP '^$st ' OR st LIKE '$st') LIMIT 1");
                                if (mysqli_num_rows($favorite) > '0') {$zam_e = mysqli_fetch_array($favorite);
                                    preg_match_all ("/^\D*(\d+)/", $zam_e['st'], $perv);
                                    $perv = $perv[1][0];
                                    $tags = preg_split("/,/", $zam_e['tags']);
                                    $tags=preg_replace ('/^\s/', '', $tags);
                                    $tags=preg_replace ('/\s$/', '', $tags);
                                    echo '<span style="position: relative; " id="fav"><img style= "cursor: pointer;" src="IMG/favorite_yes.png" /><div class="some_block1"><span style="color:#666">Теги избранного стиха</span>';

                                    for ($j=0; $j<count($tags); $j++)
                                    {
                                        if ($j==0) $tag = '<a style="color:#666; font-size:150%" href="my_favorite.php?search_tag='.$tags[$j].'">'.$tags[$j].'</a>';
                                        else $tag = $tag.'<span style="color:#666">,</span> <a style="color:#666; font-size:150%" href="my_favorite.php?search_tag='.$tags[$j].'">'.$tags[$j].'</a>';
                                    }
                                    if (empty($zam_e['tags'])) echo ' <span style="color:#FF6600">отсутствуют</span>'; else echo '<br /><br />';
                                    echo $tag.' <br /><br /><span class="del_fav"><a href="favorite_edit.php?id='.$zam_e['id'].'&diez='.$perv.'">Редактировать</a></span>';

                                    echo '</div></span> ';
                                }
                                else echo '<a href="favorite.php?kn='.$kn.'&gl='.$gl.'&st='.$st.'&diez='.$st.'"><img src="IMG/favorite.png" title="Добавить стих в избранное" /></a> ';

                                if ($name_user) {     $zam_ed = mysqli_query($connect, "SELECT DISTINCT id, text FROM host1222968_pass.zametki WHERE kn LIKE '$kn' AND gl=$gl AND st=$st AND user LIKE '$name_user'");
                                $zam_ed = mysqli_fetch_array($zam_ed);
                                if ($zam_ed['id'])
                                    echo '<a class="toggler_z" ><span id="not"><img src="IMG/notes_yes.png" title="Редактировать заметку"/ ></span></a><div id="answer_z" class="answer_z" style="display: none;"><div id="an_zag"><img src="IMG/closed.png" class="closed" /><div id="zagol_okno1">Заметка на '.$kn_sokr.' '.$gl.':'.$st.'</div><b id="status_zam"></b><br /> <TEXTAREA id="zamet" style="width: 285px; height: 260px; resize: none;">'.$zam_ed['text'].'</TEXTAREA><br /><br />    <button onclick="SendRequestzametka(\''.$kn.'\', \''.$gl.'\', \''.$st.'\', \''.$name_user.'\');" disabled class="submit">Сохранить</button><img src="IMG/loading.gif" id="loading_z" /><br /><br /><a style="font-family: Arial;" href="my_zametki.php">Все мои заметки</a></div ></div>';
                                else
                                    echo '<a class="toggler_z" ><span id="not"><img src="IMG/notes.png" title="Добавить заметку на стих"/ ></span></a><div id="answer_z" class="answer_z" style="display: none;"><div id="an_zag"><img src="IMG/closed.png" class="closed" /><div id="zagol_okno1">Заметка на '.$kn_sokr.' '.$gl.':'.$st.'</div><b id="status_zam"></b><br /> <TEXTAREA id="zamet" style="width: 285px; height: 260px; resize: none;"></TEXTAREA><br /><br />    <button onclick="SendRequestzametka(\''.$kn.'\', \''.$gl.'\', \''.$st.'\', \''.$name_user.'\');" disabled class="submit">Сохранить</button><img src="IMG/loading.gif" id="loading_z" /><br /><br /><a style="font-family: Arial;" href="my_zametki.php">Все мои заметки</a></div></div >';
                                $pr_zak = $kn_sokr.' '.$gl.':'.$st;
                                $pr_us = mysqli_query($connect, "SELECT * FROM host1222968_pass.zakladki WHERE (red LIKE '$pr_zak' OR orange LIKE '$pr_zak' OR green LIKE '$pr_zak' OR blue LIKE '$pr_zak' OR fuchsia LIKE '$pr_zak') AND name LIKE '$name_user'");
                                echo '<input id="color" type="hidden"><img style="width: 30px; margin: -4px -30px 0 0;" src="IMG/loading.gif" id="loading_zak" />';
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
                                echo BackAndForth::widget([
                                    'template' => 'chapters_bold',
                                    'current' => $chapterNum,
                                    'total' => $chaptersQTY,
                                    'params' => [
                                        'marker' => $marker,
                                    ],
                                    'urlParams' => [
                                        'book' => $bookCode,
                                        'verse' =>    1
                                    ],
                                    'currentUrlParam' => 'chapterNum',
                                    'url' => URLS::ALL['BIBLE_BOOK_CHAPTER_VERSE']
                                ]);

                                echo BackAndForth::widget([
                                    'template' => 'verses_bold',
                                    'current' => $verse->getFirst()->getVerseNumber(),
                                    'total' => $versesQty,
                                    'urlParams' => [
                                        'book' => $bookCode,
                                        'chapterNum' =>    $chapterNum
                                    ],
                                    'currentUrlParam' => 'verse',
                                    'url' => URLS::ALL['BIBLE_BOOK_CHAPTER_VERSE']
                                ]);



                                    /* Выводим толкуемый стих */

                                    echo '<div id=stih>';

                                    #################################################
                                    foreach ($verse as $verseVersion) {
                                        $version = $verseVersion->getVersion();
                                        $versionAbbr = $version->getAbbreviation();
                                        if ($versionAbbr == 'grek') {
                                            $pt_msg = '/(\w+)\b/U';
                                            $rt_msg = '<a href="search_stih.php?search=${1}&perevod=grek"><span class="grek"><b>${1}</b></span></a>';
                                            $st_text_2 = preg_replace($pt_msg, $rt_msg, $verseVersion->getContents());
                                            $st_text_2 = '<span class="grek"><b>'.$st_text_2.'</b></span>';
                                        } else {
                                            $pt_msg = '/([^\s\.,!\]\[?;:]+)([\s\.\],!?;:])/U';
                                            $rt_msg =  '<a href="search_stih.php?search=${2}&perevod='.$versionAbbr.'">${1}</a>${2}';
                                            $st_text_2 = preg_replace($pt_msg, $rt_msg, $verseVersion->getContents());
                                        }

                                        echo '<div style="color: #797979; font-weight: 900; text-align: left">'.$version->getName().'<hr /></div><b>&#0171;'.$st_text_2.'&#0187;</b><br /><br />';
                                }
                                    #################################################

                                    echo '</div>';

                                echo BackAndForth::widget([
                                    'template' => 'arrows',
                                    'current' => $verse->getFirst()->getVerseNumber(),
                                    'total' => $versesQty,
                                    'urlParams' => [
                                        'book' => $bookCode,
                                        'chapterNum' =>    $chapterNum
                                    ],
                                    'currentUrlParam' => 'verse',
                                    'url' => URLS::ALL['BIBLE_BOOK_CHAPTER_VERSE']
                                ]);
                                    ?>
                                    <br /><br />  </div>

                        </td>
                        <td style="width:200px">
                            <?= Commentaries::widget(['fromVersePointer' => $verse->getFirst()->getPointer(), 'toVersePointer' => $verse->getFirst()->getPointer(), 'bookCode' => $bookCode, 'chapterNum' => $chapterNum]); ?>
                            <?= Commentaries::widget([
                                'fromVersePointer' => $verse->getFirst()->getPointer(), 'toVersePointer' => $verse->getFirst()->getPointer(), 'bookCode' => $bookCode, 'chapterNum' => $chapterNum, 'mode' => Commentaries::MODE_RESEARCH
                            ]);
                            ?>
                            <?php /*


                                    $tabl_prop = mysqli_query($connect, "SELECT * FROM host1222968_pass.propovedi WHERE ssilka REGEXP '.*$kn_gl \[[:digit:]*|[:blank:]*]* $st .*' ORDER BY autor");
                                    $propoved = mysqli_num_rows($tabl_prop);
                                    if ($propoved) {
                                        echo '</div></div><br ><div class="box" id="boxpr">';
                                        echo '<h3 id="open2_box">';
                                        if ($open_prop == 'on') echo '<a onclick="divOp2(0);">ПРОПОВЕДИ</a>'; else echo '<a onclick="divOp2(1);">ПРОПОВЕДИ</a>';
                                        echo '</h3> 
<div id="open2" style="margin-top: -15px;padding:1px 5px;text-align:right">';
                                        if ($open_prop == 'on') echo '<a onclick="divOp2(0);"><img src="IMG/top.png" title="Скрыть"/></a></div><div id="blok_open2" ><div class="ssylki_st">';
                                        else echo '<a onclick="divOp2(1);"><img src="IMG/bottom.png" title="Раскрыть"/></a></div><div id="blok_open2" style="display: none;"><div class="ssylki_st">';
                                        for ($rt=0; $rt<mysqli_num_rows($tabl_prop); $rt++)
                                        {
                                            $prop_n = mysqli_fetch_array($tabl_prop);
                                            $p_n = '<a href="propoved.php?povod='.$prop_n['povod'].'&autor='.$prop_n['autor'].'">'.$prop_n['autor'].'</a><br /><br />';
                                            if (!in_array ($p_n, $arry_p)) $arry_p[] =$p_n;
                                        }
                                        for ($hi=0; $hi<sizeof($arry_p); $hi++) {
                                            echo $arry_p[$hi];
                                        }
                                        echo '</div></div>';
                                    }
                                    else echo '</div>';
  */
                            ?>
            </div><br/>

            <?= ParallelVerses::widget(['fromVersePointer' => $verse->getFirst()->getPointer(), 'toVersePointer' => $verse->getFirst()->getPointer()]); ?>

            <?= ReferencesFromComments::widget(['versePointer' => $verse->getFirst()->getPointer()]);?>

                                </div>
                                <br />
                                <div align="center">

                                    <a href="http://orphus.ru" id="orphus" target="_blank"><img alt="Система Orphus" src="IMG/orphus.gif" border="0" width="125" height="115" /></a>
                                </div>
                                <br />
                        </td>
                    </tr>
                </table>
                <table align="center" width="600" cellpadding="0" cellspacing="0" border="0" >
                    <tr>
                        <td>
                        </td>
                    </tr>
                </table>
