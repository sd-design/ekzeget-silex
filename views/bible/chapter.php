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


<style>
    p {font-size: <?php echo $size;?>px;}
</style>



<div class="row" id="chapter_menu">
       
    <div class="col-md-6">
            <div id="spis_per">
                    <?= VersionChooser::widget(['response' => $response, 'request' => $request]) ?>
            </div>
    </div>
    <div class="col-md-6 text-right">
    
        <?php
        // TODO generate link and add to favourite for selected verses
        ?>
        <div class='ssil_uvelich'><a style="font-family: Arial; text-decoration: none; font-weight: 900;font-size: 22px" href="javascript:decreaseFontSize(<?php echo $size;?>);" title="Уменьшить размер шрифта">A-</a>
            <a style="font-family: Arial; text-decoration: none; font-weight: 900;font-size: 22px" href="javascript:increaseFontSize(<?php echo $size;?>);" title="Увеличить размер шрифта">A+</a>
        </div>
        <div id='icon'>
            <a onclick=""><img src="<?=$assets?>/img/markup.png" title="Изменить расположение текста" /></a>
            <a href="javascript: popupURL = 'http://www.codex-sinaiticus.net/ru/manuscript.aspx?book=<?php echo $verses->getFirst()->getBook()->getManuscriptId().'&chapter='.$chapterNum;?>&lid=ru&side=r&zoomSlider=0'; ShowPopup(); "><img src="<?=$assets?>/img/svitok.png" title="Исследовать манускрипт" /></a>
            <a href="glava_stolb.php?kn=<?php echo $bookCode.'&chapterNum='.$chapterNum;?>" title="Все переводы столбцами"><img src="<?=$assets?>/img//columns.png" /></a><a href="#"><img src="<?=$assets?>/img/favorite.png" /></a>
        </div>
    </div>

</div>
 
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
            <div id="osn_text">
            <ol class="bible-poem-text">
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
     <? /* <span><a name="<?=$verseNum?>"></a><sup><b><?=$verseNum?></b></sup></span>
     <span><a style="color:<?=$hasVerseCommentColour?><?=$boldStyle?>" href="<?=$url?>" title="<?=$hasVerseCommentTxt?>">
        <?=$verse->getContents()?></a></span>*/ ?>

        <li class="fulltext"><span class="js-popover-poem-bookmark-add"><sup><?=$verseNum?></sup></span><span><a style="color:<?=$hasVerseCommentColour?><?=$boldStyle?>" href="<?=$url?>" title="<?=$hasVerseCommentTxt?>">
        <?=$verse->getContents()?></a></span>
									</li>

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
 </ol>
</div>
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

<!-- new proof центральный блок замыкающие теги-->
</div>
        </div>
        <!--правый блок -->
        <div class="col-md-3">
        
         <?= Commentaries::widget(['fromVersePointer' => $verses->getFirst()->getPointer(), 'toVersePointer' => $verses->getLast()->getPointer(), 'bookCode' => $bookCode, 'chapterNum' => $chapterNum]); ?>
         <?= Commentaries::widget([
             'fromVersePointer' => $verses->getFirst()->getPointer(), 'toVersePointer' => $verses->getLast()->getPointer(), 'bookCode' => $bookCode, 'chapterNum' => $chapterNum, 'mode' => Commentaries::MODE_RESEARCH
             ]);
         ?>

    <?= ParallelVerses::widget(['fromVersePointer' => $verses->getFirst()->getPointer(), 'toVersePointer' => $verses->getLast()->getPointer()]) ?>

    <?= Audio::widget(['bookCode' => $bookCode, 'chapterNum' => $chapterNum, 'request' => $request])?>

    <br />
    <div align="center">
<a href="http://orphus.ru" id="orphus" target="_blank"><img alt="Система Orphus" src="<?=$base_url?>/assets/IMG/orphus.gif" border="0" width="125" height="115" /></a>
</div>
        </div>
        <!-- END правый блок -->
