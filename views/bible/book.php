<?php
/**
 * @var int $versesQTY
 * @var \models\Book $book
 * @var \Propel\Runtime\Collection\ObjectCollection $chapters
 * @var \Application $app
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 * @var string $abbr
 * @var Request $request
 * @var Response $response
 */

use models\Version;
use services\URLS;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use widgets\BookCommentariesList;
use widgets\VersionChooser;

?>

<!-- виджет
<script defer type="text/javascript" src="/js/my/increaseFontSize.js"></script>
<style>
    <?php //$size = $_COOKIE['size'];?>
    p {font-size: <?php //echo $size;?>px;}
</style>
-->
<?php
$this->setTitle($book->getName()); ?>

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


        <br/>
        <?php if ($author_name = $book->getAuthor()->setLocale($app['current_locale'])->getName()): ?>
            <p><?= $app['t']('author') ?>: <b> <?= $author_name ?>.</b></p>
        <?php endif; ?>
        <?php if ($date = $book->getYear()->getDateFrom('y')): ?>
            <p><?= $app['t']('written_when') ?>: <b><?= $date ?></b></p>
        <?php endif; ?>
        <?php if ($place = $book->getPlace()->setLocale($app['current_locale'])->getName()): ?>
            <p><?= $app['t']('written_where') ?>: <b><?= $place ?>.</b></p>
        <?php endif; ?>
        <hr/>

        <p><?= $app['t']('total_chapters') ?> <b><?= $chapters->count() ?></b>
            <?= $app['t']('total_verses') ?>

            <b><?= $versesQTY ?></b>

            </b></p>
        <table boder="0">

            <?php
            $chapterNum = 1;
            for ($chaptersQTY = $chapters->count(); $chapterNum <= $chaptersQTY; $chapterNum++):
                ?>
                <tr>
                    <td><p>
                            <?php
                            $url = $app->url(URLS::ALL['BIBLE_BOOK_CHAPTER'], ['book' => $abbr, 'chapterNum' => $chapterNum]);
                            ?>
                            <a href="<?=$url?>"><?= $chapterNum ?> <?= $app['t']('chapter') ?> </a>
                            - <?= $app['t']('verses') ?> <?= $chapters->get($chapterNum - 1) ?>
                        </p></td>
                    <td style="padding-top: 5px">
                        <?php
                        $audioSrc = Version::getAudioSrc($app, $abbr, $chapterNum);//TODO: copyrights
                        if (file_exists($audioSrc)):?>
                            <audio preload="metadata" controls style="width:300px">
                                <source src="<?= Version::getAudioUrl($app, $audioSrc) ?>" type="audio/mpeg">
                                <?= $app['t']('audio_tag_is_not_supported') ?>
                            </audio>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endfor; ?>
        </table>

    </div>
</td>


            <!--правый блок -->
            <div class="col-md-3">
        
            <?= BookCommentariesList::widget(['book' => $book]) ?>

    <br />
    <div align="center">
<a href="http://orphus.ru" id="orphus" target="_blank"><img alt="Система Orphus" src="<?=$base_url?>/assets/IMG/orphus.gif" border="0" width="125" height="115" /></a>
</div>
        </div>
        <!-- END правый блок -->
