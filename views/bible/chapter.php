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
            <a hraf="#" ng-click="checkRead($event)"><img src="<?=$assets?>/img/markup.png" title="Изменить расположение текста" /></a>
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
            <div class="loading"></div>
            <ul class="bible-poem-text">
                <!-- Angular text -->
                <li class="fulltext" ng-repeat="item in myData.verses"><span class="js-popover-poem-bookmark-add"><sup>{{item.VerseNumber}}</sup>
                </span><span ng-bind-html="item.Contents | to_trusted"></span>
            </li>
 </ul>
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

         <?//Отключил этот виджет, потому что он дублирует предыдущий блок 
         /* = Commentaries::widget([
             'fromVersePointer' => $verses->getFirst()->getPointer(), 'toVersePointer' => $verses->getLast()->getPointer(), 'bookCode' => $bookCode, 'chapterNum' => $chapterNum, 'mode' => Commentaries::MODE_RESEARCH
             ]);
         */?>

    <?= ParallelVerses::widget(['fromVersePointer' => $verses->getFirst()->getPointer(), 'toVersePointer' => $verses->getLast()->getPointer()]) ?>

    <?= Audio::widget(['bookCode' => $bookCode, 'chapterNum' => $chapterNum, 'request' => $request])?>

    <br />
    <div align="center">
<a href="http://orphus.ru" id="orphus" target="_blank"><img alt="Система Orphus" src="<?=$base_url?>/assets/IMG/orphus.gif" border="0" width="125" height="115" /></a>
</div>
        </div>
        <!-- END правый блок -->
