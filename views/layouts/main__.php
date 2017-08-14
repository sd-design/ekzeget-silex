<?php
/**
 * @var \Application $app
 * @var string $contents
 * @var \services\ViewServiceProvider $this
 * @var string $assets
 */
use models\Map\BookTableMap;
use models\Map\PageWidgetTableMap;
use services\URLS;
use widgets\BooksList;
use widgets\Reading;
use widgets\RegistrationInvitation;
use widgets\RegularVisitor;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="Библия Онлайн, толкование Священного Писания, переводы Библии, планы чтения Библии, Евангелие, аудиобиблия, слушать Библию, Библейские карты" />
    <meta name="description" content="Самая функциональная Онлайн Библия. На сайте имеются толкования Священного Писания, множество переводов Библии, аудиобиблия, планы чтения Библии, Библейские карты. Читайте и изучайте Священное Писание, оставляйте закладки на нужные стихи, пишите заметки, делитесь толкованиями с друзьями" />


    <meta property="og:image" content="<?=$assets?>/img/soc_kniga.png" />
    <link rel="image_src" href="<?=$assets?>/img/soc_kniga.png">
    <link rel="apple-touch-icon" href="<?=$assets?>/img/soc_kniga.png" />

    <link rel="apple-touch-icon" href="<?=$assets?>/img/soc_kniga60x60.png" sizes="60x60" />
    <link rel="apple-touch-icon" href="<?=$assets?>/img/soc_kniga76x76.png" sizes="76x76" />
    <link rel="apple-touch-icon" href="<?=$assets?>/img/soc_kniga120x120.png" sizes="120x120" />
    <link rel="apple-touch-icon" href="<?=$assets?>/img/soc_kniga152x152.png" sizes="152x152" />

    <link rel="icon" href="/assets/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon">

    <?php
    \views\assets\LegacyMainAsset::register($this);
    $this->assets();
    ?>

    <meta name='yandex-verification' content='6940e802632820aa' />
    <title><?=$this->getTitle()?></title></head><body>


<table align="center" width="1000" cellpadding="0" cellspacing="0" border="0" style="margin-top:5px">
    <tr>
        <td>
            <div style="text-align: left; margin-left: 0;">
                <a href="pravila.php"><div class="tehnav" style="padding-left:0"> Правила</div></a>
                <a href="new_tolk.php"><div class="tehnav"> Обновления </div></a>

                <a href="generator.php"><div class="tehnav">Генератор ссылок</div></a>
                <a href="search.php"><div class="tehnav"> Поиск </div></a>
                <a href="zap.php"><div class="tehnav"> Гостевая </div></a>
            </div>
            <div class="nav_verh" style="margin-top: -5px; font-family: 'Times New Roman'; font-size: 16px;float: right; border: 1px #C7C7C7; border-style: none solid solid solid; padding: 7px 10px 5px 10px; background: #fff;position: relative ;">
                <?php
                if (!$app['session']->get('loggedin')) {
                    echo 'Здравствуйте, <b>Гость</b> | <a href="auth.php">Вход</a> | <a href="registr.php">Регистрация</a>';
                }
                echo RegularVisitor::widget(['top' => 240]);
                echo RegistrationInvitation::widget();
                ?></div>
        </td>
    </tr>
</table>

<table align="center" cellpadding="0" cellspacing="0" border="0" style="width: 1000px; margin-top:10px">
    <tr>
        <td>
            <div style="height:180px; width:300px; border: 1px solid #C7C7C7;">
                <div id ="chten">
                    <?= Reading::widget()?>
                </div>
            </div>

        </td>
        <td style="width:610px; text-align: right">
            <div style="width:610px;">

                <div style="margin: 10px 40px 0 0;">
                    <a href = "/.."><img src="<?=$assets?>/img/ekzeget.png" style="width:470px; height:102px" title="На главную страницу" /></a>
                </div>
                <table style="text-align: right; margin: 34px 0 0 155px; position: absolute; z-index: 1; border: none">
                    <tr><td>

                            <div>
                                <div class="nav" id="n1" style="border-radius: 5px 5px 0 0;border: 4px #FCCCBC; border-style: solid solid none">

                                    <a href="lektorij.php">
                                        <div style=" padding: 9px 7px 10px 9px; float: left"> Лекторий</div></a>
                                </div>
                                <div class="nav" id="n2" style="border-radius: 5px 5px 0 0;border: 4px #CCF4B4;border-style: solid solid none">

                                    <a href="<?= $app->url(URLS::ALL['COMMENTARY_AUTHORS']) ?>">
                                        <div style="padding: 9px 7px 10px 9px; float: left"> <?= $app['t']('exegets') ?></div></a>
                                </div>
                                <div class="nav" id="n3" style="border-radius: 5px 5px 0 0;border: 4px #CDEEFF;border-style: solid solid none">

                                    <a href="maps.php">
                                        <div style="padding: 9px 14px 10px 12px; float: left"> Карты </div></a>
                                </div>

                                <div class="nav" id="n4" style="border-radius: 5px 5px 0 0;border: 4px #FCFCA4;border-style: solid solid none">

                                    <a href="slovari.php">
                                        <div style="padding: 9px 7px 10px 9px; float: left"> Словари</div></a>
                                </div>
                                <div class="nav" id="n5" style="border-radius: 5px 5px 0 0;border: 4px #CCCCFC;border-style: solid solid none">

                                    <a href="propovedi.php">
                                        <div style="padding: 9px 7px 10px 9px; float: left"> Проповеди</div></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </td>
        <td style="width:90px;text-align: center;">
            <div style="width:90px;">

                <div class="rss"><div style="display: none;" class="t2">
                        <?php //if ($auth == '1') echo '<a href="cell_my.php">Моя келия</a><br />';?>
                        <?php //if ($auth == '2') echo '<a href="cell.php">Моя келия</a><br />';?>

                        <a href="my_tolk.php">Мои толкования</a><br />
                        <a href="http://<?php //echo $url_pl; ?>plan_posl=yes"
                            <?php
                           // if ($plan_red && $plan_red == '1') echo 'style="color:red"';
                            ?>
                        >План чтения</a> &nbsp <a href="my_plan.php" title="Настроить план чтения" style="color:#888; font-size:90%">ред.</a><br />
                        <a href="my_zametki.php">Заметки</a><br />
                        <a href="my_favorite.php">Избранные стихи</a><br />
                        <a href="my_fav_tolk.php">Избранные толкования</a><hr />
                        <a href="exit.php">Выход</a>
                    </div>
                    <a href="http://vk.com/ekzeget" target="_blank" title="Мы ВКонтаке">
                        <img style="margin-bottom: 2px" src="<?=$assets?>/img/vk.png" /></a><br />
                    <a href="https://www.facebook.com/groups/ekzeget/" target="_blank" title="Мы на Facebook'e">
                        <img style="margin-bottom: 2px" src="<?=$assets?>/img/f.png" /></a><br />
                    <a href="mailto:admin@ekzeget.ru" title="Написать администратору">
                        <img style="margin-bottom: 2px" src="<?=$assets?>/img/pda.png" /></a></div>
            </div>
        </td>
    </tr>
</table>



<table align="center" cellpadding="0" cellspacing="0" style="margin-top: 10px; width: 100%; background: #4876FF; text-align: center; padding: 5px 40px 5px 5px; border: 1px solid #284EC2;z-index: 2"><tr><td ><h1 style="font-family: 'Book Antiqua';color: #fff; font-size: 30px;font-weight: normal;margin-top: 0"><?=$this->getTitle()?> [my]</h1>
        </td></tr></table><table align="center" width="1000" cellpadding="0" cellspacing="0" border="0" style="margin-top:0">
    <tr><td style="width:180px">
            <!-- НАЧАЛО МЕНЮ -->
            <div style="width:170px">
                <h3 class="h3menu">НОВЫЙ ЗАВЕТ</h3>
                <ul id="verticalmenu" class="glossymenu"  style="border-top: 1px solid #C7C7C7; ">
                    <?= BooksList::widget(['testament' => BookTableMap::COL_TESTAMENT_NT])?>
                </ul>
                <br />
                <h3 class="h3menu">ВЕТХИЙ ЗАВЕТ</h3>
                <ul id="verticalmenu" class="glossymenu"  style="border-top: 1px solid #C7C7C7; ">
                    <?= BooksList::widget(['testament' =>  BookTableMap::COL_TESTAMENT_OT])?>
                </ul><br /><span style="padding-left: 10px; font-size:80%">* - неканонические книги</span><br />

                <!-- КОНЕЦ МЕНЮ -->

                <br/>
                <!-- banners -->
                <!--noindex-->
                <a style="color:red" href="http://fond.predanie.ru/blago/340442/">Помочь нашему проекту</a><br /><br /><div style="width: 130px; border: 1px solid #C7C7C7; text-align: center; padding: 15px 5px;margin:0 10px">
                    <a href="banners.php">НАШИ<br />БАННЕРЫ</a>
                </div><br /><br />
                <div class="banners" align="center">
                    <!-- Put this div tag to the place, where the Like block will be -->
                    <div id="vk_like" style="width: 100px"></div>
                    <br />
                    <div id="fb-root" style="width: 100px"></div>
                    <div class="fb-like" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false" style="width: 100px"></div>
                    <br /><br />

                    <div id="ok_shareWidget"></div>
                </div>
                <br /><br /><br /><br />
            </div>
            <!-- banners -->
        </td>

        
   <?=$contents?>


        <td style="width:200px">
        <br /><span style="font-size:12px;color:#666">Наши друзья:</span><br /><br /><div style="text-align:center; margin-left:-10px">
            <a href="http://fond.predanie.ru/?banner=1" target="_blank"><img src="http://fond.predanie.ru/banner/new/static/banner_predanie-200x100-01.gif"></a><br /><br />
            <A href="http://www.bogoslov.ru" target="_blank"><IMG src="http://www.bogoslov.ru/images/banners/banner_bogoslov_293x79.gif" WIDTH=200 BORDER=0 ALT="Богослов.ру"></A>
        </div><br />
        <?php if(isset($this->widgets[PageWidgetTableMap::COL_AREA_RIGHT])):?>
            <?php foreach ($this->widgets[PageWidgetTableMap::COL_AREA_RIGHT] as $widget):?>
            <div class="box"><?= $widget ?></div>
            <?php endforeach;?>
        <?php endif;?>
        <br /><div align="center">

            <a href="http://orphus.ru" id="orphus" target="_blank"><img alt="Система Orphus" src="<?=$assets?>/img/orphus.gif" border="0" width="125" height="115" /></a>
        </div><br /></td></tr></table>

<div id="message">
    <a id="toTop" href="#"><img src="<?=$assets?>/img/vverh.png" /></a></div><div id="footer">
    <table width="1000" align="center" cellpadding="7" cellspacing="0" style="background: #ddd; border: 1px solid #AFAFAF;">
        <tr >
            <td colspan=2>
                <a href="pravila.php"> Правила</a> |
                <a href="new_tolk.php">Обновления</a> |
                <a href="generator.php"> Генератор ссылок</a> |
                <a href="search.php"> Поиск</a> |
                <a href="zap.php"> Гостевая</a> <br />
                <a href="propovedi.php">Проповеди</a> |
                <a href="slovari.php">Словари</a> |
                <a href="maps.php"> Карты</a> |
                <a href="tolks_all.php"> Экзегеты</a> |
                <a href="lektorij.php"> Лекторий</a> <br /><br />

            </td>
            <td align="right" width="400" style="vertical-align: top">
                <a href="http://pda.ekzeget.ru<?php echo $_SERVER['REQUEST_URI'];?>">Мобильная версия</a>
            </td>
        </tr>

        <tr>
            <td style="border-top: 1px solid #AFAFAF;vertical-align: top"><br />
                <img src="<?=$assets?>/img/ya.png" title="Пожертвование на развитие проекта"/><br />
                <iframe frameborder="0" allowtransparency="true" scrolling="no" src="https://money.yandex.ru/embed/small.xml?account=41001159830176&quickpay=small&yamoney-payment-type=on&button-text=04&button-size=s&button-color=white&targets=%D0%9F%D0%BE%D0%B6%D0%B5%D1%80%D1%82%D0%B2%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D0%B5+%D0%BD%D0%B0+%D1%81%D0%B0%D0%B9%D1%82+ekzeget.ru&default-sum=100" width="155" height="31"></iframe>
                <br />
                <span style="color:green">Кошелек № 41001159830176 </span>
                <hr />
                <img src="<?=$assets?>/img/qiwi.png" title="Пожертвование на развитие проекта"/><br />
                <span style="color:green">Кошелек № +79378737360 </span>
                <hr />
                <img src="<?=$assets?>/img/webmoney.png" title="Пожертвование на развитие проекта"/><br />
                <span style="color:green">WMR Кошелек № R328560859534 </span>
                <span style="color:green">WMZ Кошелек № Z726683259332 </span>

            </td>
            <td align="left" style="border-top: 1px solid #AFAFAF; color: #222"><br />
                <b>Реквизиты для пожертвований:</b><br />
                Наименование Банка получателя:    АО "БАНК РУССКИЙ СТАНДАРТ"<br />
                Номер счета в банке:    40817810800993212857<br />
                БИК:    044525151<br />
                ИНН:    7707056547<br />
                К/с:    30101810845250000151<br />
                Получатель платежа: ЖИДКОВ СЕРГЕЙ ВЛАДИМИРОВИЧ<br />
                С пометкой "на сайт Экзегет.ру".<br /><br />
            </td>
            <td style="border-top: 1px solid #AFAFAF;color: #222"><br />
                <b>Реквизиты в Сбербанке:</b><br />
                Наименование Банка получателя: УЛЬЯНОВСКОЕ ОТДЕЛЕНИЕ N8588 ПАО СБЕРБАНК Г.УЛЬЯНОВСК<br />
                Номер счета в банке:    40817810769000398126<br />
                БИК:    047308602<br />
                ИНН:    7707083893<br />
                КПП:    732502002<br />
                К/с:    30101810000000000602<br />
                Получатель платежа: ЖИДКОВ СЕРГЕЙ ВЛАДИМИРОВИЧ<br />
                С пометкой "на сайт Экзегет.ру".<br />

            </td>

        </tr>
        <tr>
            <td colspan="3" style="text-align:center"><br />
                <A href="http://www.bogoslov.ru" target="_blank"><IMG src="http://www.bogoslov.ru/data/548/330/1234/banner_88x31.png" HEIGHT=31 WIDTH=88 BORDER=0 ALT="Богослов.ру"></A> &nbsp;
                <a href="http://fond.predanie.ru/?banner=1" target="_blank"><img src="http://fond.predanie.ru/banner/new/static/banner_predanie-88x31_0.gif"></a> &nbsp;
                <a href='http://www.barysh-eparhia.ru/' target="_blank"><img src='http://www.barysh-eparhia.ru/IMG/banner_mini.png' width=88 height=34 title="Барышская епархия" alt='Барышская епархия'></a> &nbsp;
                <a href="http://www.андреевский-храм.рф/" target="_blank"><img
                        src="http://www.андреевский-храм.рф/IMG/Banner.png"
                        title="Храм апостола Андрея Первозванного" width=88 height=31 border=0></a> &nbsp;
                <!--begin of www.hristianstvo.ru
                <a href="http://www.hristianstvo.ru/?from=13606" target="_blank"><img
                src="http://www.hristianstvo.ru/images/ru-88x31-lightgray1.gif"
                title="Православное христианство.ru" width=88 height=31 border=0></a> &nbsp;
                end of www.hristianstvo.ru-->

                <!-- Yandex.Metrika informer --> &nbsp;
                <a href="https://metrika.yandex.ru/stat/?id=23728522&amp;from=informer"
                   target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/23728522/2_1_FFFFFFFF_EFEFEFFF_0_pageviews"
                                                       style="width:80px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры)" onclick="try{Ya.Metrika.informer({i:this,id:23728522,lang:'ru'});return false}catch(e){}" /></a> &nbsp;
                <!-- /Yandex.Metrika informer -->
                <noscript><div><img src="https://mc.yandex.ru/watch/23728522" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
                <!-- /Yandex.Metrika counter -->

                <noscript><div style="position:absolute;left:-10000px;">
                        <img src="//top-fwz1.mail.ru/counter?id=2566972;js=na" style="border:0;" height="1" width="1" alt="Рейтинг@Mail.ru" />
                    </div></noscript>
                <!-- //Rating@Mail.ru counter -->
                <!-- Rating@Mail.ru logo -->
                <a href="http://top.mail.ru/jump?from=2566972">
                    <img src="//top-fwz1.mail.ru/counter?id=2566972;t=361;l=1"
                         style="border:0;" height="18" width="88" alt="Рейтинг@Mail.ru" /></a>
                <!-- //Rating@Mail.ru logo -->
                <!--/noindex-->&nbsp;
                <br /><br />
            </td></tr>
        <tr>
            <td colspan="2" width="250" style="vertical-align: bottom"><span style="font-size: 13px; text-align: center; color: #333">
<b>© С. Жидков, 2011 - 2017 гг.</b><br /></span>
            </td>

            <td align="right" width="400" style="vertical-align: bottom">


            </td>
        </tr>
    </table>
</div><br />
<script type="text/javascript" src="<?=$assets?>/js/orphus.js"></script>

</body></html>
