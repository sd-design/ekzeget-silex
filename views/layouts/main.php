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
<!DOCTYPE html><html lang="ru"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="keywords" content="Библия Онлайн, толкование Священного Писания, переводы Библии, планы чтения Библии, Евангелие, аудиобиблия, слушать Библию, Библейские карты" />
<meta name="description" content="Библия от «А» до «Я»: тексты Священного Писания в оригинале, и в различных переводах, толкования Отцов Церкви и современных богословов, исторические комментарии и справочники, интерактивные путешествия во времени и пространстве, аудиокниги и лекции. Ekzeget.ru - ваш проводник в мир Библии" /><meta property="og:image" content="<?=$assets?>/IMG/soc_kniga.png" />
<link rel="image_src" href="/IMG/soc_kniga.png" /><link rel="apple-touch-icon" href="<?=$assets?>/IMG/soc_kniga.png" /><link rel="apple-touch-icon" href="<?=$assets?>/IMG/soc_kniga60x60.png" size="60x60" /><link rel="apple-touch-icon" href="<?=$assets?>/IMG/soc_kniga76x76.png" size="76x76" /><link rel="apple-touch-icon" href="<?=$assets?>/IMG/soc_kniga120x120.png" size="120x120" /><link rel="apple-touch-icon" href="<?=$assets?>/IMG/soc_kniga152x152.png" size="152x152" />
<title><?=$this->getTitle()?></title>
<link rel="icon" href="<?=$assets?>/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?=$assets?>/favicon.ico" type="image/x-icon" />
<link href="https://fonts.googleapis.com/css?family=Roboto+Mono|Roboto:400,700,900" rel="stylesheet">
<?php
    \views\assets\LegacyMainAsset::register($this);
    $this->assets();
    ?>
<!--noindex-->
<!-- Скрипты кнопок соцсетей -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?105"></script>
<script  type="text/javascript">
 VK.init({apiId: 4011940, onlyWidgets: true});
</script>
<script  type="text/javascript">
VK.Widgets.Like("vk_like", {type: "mini"});
</script>
<!-- Счетчики -->


<!-- Счетчики -->
<!--/noindex-->
<meta name='yandex-verification' content='6940e802632820aa' />
</head>
<body>
<section id="head">
    <div class="container">
        <nav class="navbar navbar-default">

            <div class="navbar-header">
                <ul class="nav navbar-nav">
                    <li><a href="<?=$base_url?>/o_proekte"><div class="tehnav" style="padding-left:0"> О проекте</div></a></li>
                    <li><a href="<?=$base_url?>/new_tolk"><div class="tehnav"> Обновления </div></a></li>
                    <li><a href="<?=$base_url?>/generator"><div class="tehnav">Генератор ссылок</div></a></li>
                    <li><a href="<?=$base_url?>/zap"><div class="tehnav"> Гостевая </div></a></li>
                </ul>
            
        </div>
 <div class="navbar-right">
              <div class="nav_verh">
              <?php
              if (!$app['session']->get('loggedin')) {
                  echo 'Здравствуйте, <b>Гость</b> | <a href="auth">Вход</a> | <a href="registration">Регистрация</a>';
              }
              echo RegularVisitor::widget(['top' => 240]);
              echo RegistrationInvitation::widget();
              ?>
        </div>
        </div>

</nav>

<div class="jumbotron">
    <div class="row">
        <div class="col-md-4"><!-- Календарь -->
      <!--noindex-->
<div class="calendar_inside">
    <div id ="chten">
                <div id="response">
                            <div class="icon-calendar"><a id="toggler" title="Перейти на любую дату чтения"><img src="<?=$assets?>/IMG/day.png"/ ></a>
                            </div>
                            <div id="answer" style="display: none;">Введите дату богослужебных чтений:<br /> <input type="date" id="data_today" maxlength="15" pattern="\d+.+" placeholder="гггг.мм.дд">     <button type="submit" onclick="SendRequestPOST();" name="submit" style="padding: 6px 8px 5px 8px;font-size: 11px;">OK</button>
                            </div>
                            <div id="chten_today">Сегодня <font color=#DF0404>28 июля</font></div>
                            <div class="p_content3">
                                <div id="page_content3" class="scroll-pane1">
                                    <!-- ajax block -->
                                    <div style="text-align: center"><span style=" font-size: 13px;">Четверг 10-й седмицы по Пятидесятнице</span></div><div style="text-align: center"><span style=" font-size: 13px;">Смоленской иконы Божией Матери «Одигитрия» (Путеводительница)</span>
                                    </div>
                                    <div style="text-align: center">
                                        <span style="font-size: 13px;">Святителя Питирима Тамбовского</span></div><hr style="width:100%;"><span style=" font-size: 13px;"><b>Утреня:</b> <span style="color:#666"><a href="glava.php?kn_rus=Лк&amp;gl=1&amp;marker_st=39-49, 56&amp;tolk=&amp;data_today=10.08.2017#39">Лк. 1:39-49, 56</a></span>
                                        <br><b>Литургия:</b> Ап.: <span style="color:#666"><a href="glava.php?kn_rus=2 Кор&amp;gl=1&amp;marker_st=1–7&amp;tolk=&amp;data_today=10.08.2017#1">2 Кор. 1:1–7</a> Богородицы: <a href="glava.php?kn_rus=Флп&amp;gl=2&amp;marker_st=5-11&amp;tolk=&amp;data_today=10.08.2017#5">Флп. 2:5-11</a> или Свт.: <a href="glava.php?kn_rus=Евр&amp;gl=13&amp;marker_st=17-21&amp;tolk=&amp;data_today=10.08.2017#17">Евр. 13:17-21</a>,</span> Ев.: <span style="color:#666"><a href="glava.php?kn_rus=Мф&amp;gl=21&amp;marker_st=43–46&amp;tolk=&amp;data_today=10.08.2017#43">Мф. 21:43–46</a> Богородицы: <a href="glava.php?kn_rus=Лк&amp;gl=10&amp;marker_st=38-42&amp;tolk=&amp;data_today=10.08.2017#38">Лк. 10:38-42</a>, <a href="glava.php?kn_rus=Лк&amp;gl=11&amp;marker_st=27-28&amp;tolk=&amp;data_today=10.08.2017#27">Лк. 11:27-28</a> или Свт.: <a href="glava.php?kn_rus=Лк&amp;gl=6&amp;marker_st=17-23&amp;tolk=&amp;data_today=10.08.2017#17">Лк. 6:17-23</a></span><br></span>
                                    <!-- end ajax block -->
                            </div>
                    </div>
                    <div id="zavtr_chten"><input id="dat_send" type="hidden"><a onclick="$('#dat_send').attr('value', '27.07.2017'); SendRequest();" rel="nofollow" title="Предыдущий день">&#8592; Пред.</a> <span style="color: #c4c4c4;">|</span> <a style="color: #c4c4c4; cursor: text;text-decoration: none;">Сегодня</a> <span style="color: #c4c4c4;">|</span> <a onclick="$('#dat_send').attr('value', '29.07.2017');SendRequest();" rel="nofollow" title="Следующий день">След. &#8594;</a>
                    </div>
                </div>
    </div>
</div>
<!--/noindex-->  
        </div>
        <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6"><a href = "/.."><img src="<?=$assets?>/IMG/logo.png" style="height:70px; margin-left: 45px; margin-top: 2px" title="Экзегет. Библия и толкования" /></a></div>
                    <div class="col-md-6">
                        <div class="rss">
                        <a href="https://vk.com/ekzeget" target="_blank" title="Мы ВКонтакте">
                        <img style="margin: 0 5px 0 0" src="/IMG/vk.png" /></a> 
                        <a href="https://www.facebook.com/groups/ekzeget/" target="_blank" title="Мы на Facebook'e">
                        <img style="margin: 0 5px 0 0" src="/IMG/f.png" /></a> 
                        <a href="https://twitter.com/EkzegetRU" target="_blank" title="Мы в твиттере">
                        <img style="margin: 0 5px 0 0" src="/IMG/tvit.png" /></a>
                        <a href="https://www.youtube.com/channel/UCymsjx24eU3kRFUjeBsh47A" target="_blank" title="Наш канал на YouTube">
                        <img style="margin: 0 5px 0 0" src="/IMG/youtube.png"></a>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <!--noindex-->
    <form action="search_stih.php" method="get">
        <div class="search_pano"> 
<input id="search" type="search" name="search" maxlength="100" class="form-control" required pattern="[^<|^>]{3,}" placeholder="Поиск...">
<a onclick="advanced_search();" title="Расширенный поиск" id="togglersearch" class="search-settings"><img src="<?=$assets?>/IMG/search_settings.png" title="Расширенный поиск"></a></a>
<button class="search_button" type="submit"><img src="<?=$assets?>/IMG/search.png" title="Начать поиск" style="width: 90%;"></button>
                <div style="display: none;" class="tsear">
                <div id="res_advanced">
                <br /><div style="text-align: center;"><img src="<?=$assets?>/IMG/loading.gif" style="width:50px" /></div><br />
                </div>

                </div>
        </div>
    </form>
<!--/noindex-->
                        <div class="general_menu">
                        <a href="<?=$base_url?>/propovedi" class="btn btn-default">Проповеди</a>
                        <a href="<?=$base_url?>/slovari" class="btn btn-default">Словари</a> 
                        <a href="<?=$base_url?>/maps" class="btn btn-default">Карты</a> 
                        <a href="<?=$base_url?>/tolks_all" class="btn btn-default">Экзегеты</a> 
                        <a href="<?=$base_url?>/lektorij" class="btn btn-default">Лекторий</a> 
                        </div>
                    </div>
                </div>
        </div>
    </div>
     
</div>
    </div>
</section>
<section id="ekzeget">
    <div class="container"><h1><?=$this->getTitle()?></h1></div>
</section>

<section id="page">
<div class="container">
    <div class="row">
        <!--левый блок -->
        <div class="col-sm-3">
        <!-- НАЧАЛО МЕНЮ -->
            <ul id="myTab" class="nav nav-tabs">
                <li class="active"><a class="menu_bible" href="#panel1">Новый Завет</a></li>
                <li><a class="menu_bible" href="#panel2">Ветхий Завет</a></li>
            </ul>
                <div class="tabsmenu">
                    <div class="tab-content">
                        <div id="panel1" class="tab-pane fade in active">
                            <div id="menu_nz">
                                <ul id="verticalmenu" class="glossymenu"  style="border-top: 1px solid #C7C7C7; ">
                                <?= BooksList::widget(['testament' => BookTableMap::COL_TESTAMENT_NT])?>
                                </ul>
                            </div>
                    </div>
                <div id="panel2" class="tab-pane fade">
                <div id="menu_vz">
                <ul id="verticalmenu" class="glossymenu"  style="border-top: 1px solid #C7C7C7; ">
                <?= BooksList::widget(['testament' =>  BookTableMap::COL_TESTAMENT_OT])?>
                </ul><br /><span style="padding-left: 10px; font-size:80%">* - неканонические книги</span><br />

                </div>
                </div>
            </div>
    </div>
<!-- КОНЕЦ МЕНЮ -->
<br/>
        <!-- BANNERs -->
        <!--noindex-->
        <div class="pano-banners calendar_inside text-center">
                <br />
                <a href="https://fond.predanie.ru/blago/340442/" class="btn btn-lg btn-danger btn-shadow">Помочь нашему проекту</a><br />
                <br />
                <a href="/banners" class="btn btn-lg btn-warning btn-shadow">Наши баннеры</a>
                <div class="banners" align="center">
                    <!-- Put this div tag to the place, where the Like block will be -->
                    <div id="vk_like" style="width: 100px"></div>
                    <br />
                    <div id="fb-root" style="width: 100px"></div>
                    <div class="fb-like" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false" style="width: 100px"></div>
                    <br /><br />

                    <div id="ok_shareWidget"></div>
                </div>
        </div>
        <!--/noindex-->
        <!-- END BANNERs -->
        </div>
        <!--центральный блок -->
        <div class="col-sm-6 page-control">
        <iframe width="100%" height="273" src="https://www.youtube.com/embed/k67h4aeKXg8?rel=0" frameborder="0" allowfullscreen=""></iframe>

            <div class="page-content"><hr />
            <?=$contents?>
                <div class="news-list">
                    <h3>НОВОСТИ</h3>
                    <hr class="ekz">
                        <ul class="news">
                            <li><h4>19 июл. 2017 г.</h4>
                            <p>Сейчас на сайте размещено <b>144 273</b> толкования на 33 365 стихов Священного Писания. Всего в Библии 37 107 стихов, то есть толкования имеются примерно на <b>90%</b> всего Священного Писания (на весь Новый Завет и часть Ветхого).</p>
                            </li>
                            <li><h4>4 мая 2017 г.</h4>
                            <p>Улучшена функция по добавлению личных закладок. Теперь, добавляя закладку, Вы тут же видите, какие цвета закладок уже заняты другими Вашими закладками, а какие свободны.<br/>
                            <p>Функция закладок (как и многие другие полезные функции) доступна только зарегистрированным пользователям.</p>
                            </li>
                            <li><h4>24 апреля 2017 г.</h4>
                            <p>Библия (от греч. βιβλία – книги) – собрание Богодухновенных книг, написанных пророками и апостолами по велению Духа Божия.<br />Еще больше информации о Библии, история написания и некоторые факты о ней на нашем <a href="#">сайте.</a>
                            </p>
                            </li>
                            <li><h4>19 апр. 2017 г.</h4>
                            <p>Сейчас на сайте размещено 132 786 толкований 349 экзегетов на 31 572 стиха Священного Писания. Толкования имеются примерно на 85% всего Священного Писания (на весь Новый Завет и часть Ветхого).
                            </p>
                            </li>
                        </ul>
                </div>
                <div class="news-list">
                    <h3>ОБНОВЛЕНИЯ</h3>
                    <hr class="ekz">
                        <ul class="news" id="update">
                            <li><h4>14 авг. 2017 г. 08:35</h4>
                            <p><span class="blood">3 Цар. 7:21.</span> <a href="">Ишодад из Мерва</a> (Александр Самойлов).</p>
                            </li>
                            <li><h4>14 авг. 2017 г. 08:33</h4>
                            <p><span class="blood">3 Цар. 7:20.</span> <a href="">Беда Достопочтенный</a> (Александр Самойлов).</p>
                            </li>
                            <li><h4>14 авг. 2017 г. 08:31</h4>
                            <p><span class="blood">3 Цар. 7:19.</span> <a href="">Беда Достопочтенный</a> (Александр Самойлов).</p>
                            </li>
                            <li><h4>14 авг. 2017 г. 06:54</h4>
                            <p><span class="blood">3 Цар. 7:18.</span> <a href="">Беда Достопочтенный</a> (Александр Самойлов).</p>
                            </li>
                            <li><h4>14 авг. 2017 г. 06:51</h4>
                            <p><span class="blood">3 Цар. 7:17.</span> <a href="">Беда Достопочтенный</a> (Александр Самойлов).</p>
                            </li>

                        </ul>
                </div>
            </div>
        </div>
        <!--правый блок -->
        <div class="col-md-3">
            <div class="box" id="boxpr"><h3>&#949;&#960;&#953;&#947;&#961;&#945;&#966;&#951;</h3>
                <hr class="ekz">
                <p class="epigraph">"Различные толкования даются не для того, чтобы их сравнивать и сопоставлять, какое из них лучше и адекватнее: каждое из них будет оправданным, если поможет хотя бы одному из тех, кто встал на путь богопознания, продвинуться по этому пути".</b></p><p style='text-align: right; margin-right: 10px;'>Гайденко В.П.</p><br />
            </div>
            <div class="calendar_inside box2 text-center">
            <h4>Наши друзья:</h4>
<a href="http://fond.predanie.ru/?banner=1" target="_blank"><img src="https://ekzeget.ru/IMG/partners/banner_predanie-200x100-01.gif"></a><br /><br />
<a href="http://www.bogoslov.ru" target="_blank"><IMG src="https://ekzeget.ru/IMG/partners/banner_bogoslov_293x79.gif" WIDTH=200 BORDER=0 ALT="Богослов.ру"></a><br /><br />
<!-- banner Elitcy was add 26.07.17 -->
<a href="https://dialog.elitsy.ru/"><img src="https://s3-eu-west-1.amazonaws.com/elitsy/static/b/questions_elitsy_200x90.png" border="0" alt="православная социальная сеть «Елицы»" width="200" height="90" /></a><br />
</div><br />
<div class="box"> 
</div><div align="center">

<a href="http://orphus.ru" id="orphus" target="_blank"><img alt="Система Orphus" src="<?=$base_url?>/assets/IMG/orphus.gif" border="0" width="125" height="115" /></a>
</div>
        </div>
   
</div>
</section>

<footer class="footer_pano">
<!--noindex-->
<div id="message">
<a id="toTop" href="#"><img src="<?=$assets?>/IMG/vverh.png" /></a></div>
<div class="container">
        <div class="footer-menu">
            <div class="row">
                <div class="col-md-3"><a href="/.."><img src="<?=$assets?>/IMG/logo.png" class="logo-bottom" title="Экзегет. Библия и толкования"></a></div>
                <div class="col-md-6">
                    <a href="<?=$base_url?>/pravila"> Правила</a> |
                    <a href="<?=$base_url?>/new_tolk">Обновления</a> |
                    <a href="<?=$base_url?>/generator"> Генератор ссылок</a> |
                    <a href="<?=$base_url?>/search"> Поиск</a> |
                    <a href="<?=$base_url?>/zap"> Гостевая</a> <br />
                    <a href="<?=$base_url?>/propovedi">Проповеди</a> |
                    <a href="<?=$base_url?>/slovari">Словари</a> |
                    <a href="<?=$base_url?>/maps"> Карты</a> |
                    <a href="<?=$base_url?>/tolks_allp"> Экзегеты</a> |
                    <a href="<?=$base_url?>/lektorij"> Лекторий</a> | <a href="https://pda.ekzeget.ru/">Мобильная версия</a>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="<?=$base_url?>/donation" class="btn btn-lg btn-donation">Пожертвовать</a>     
                </div>
            </div>
        </div>
        <hr>
        <div class="banners-bottom">
            <a href="http://www.bogoslov.ru" target="_blank"><img src="https://ekzeget.ru/IMG/partners/banner_88x31.png" height=31 width=88 BORDER=0 alt="Богослов.ру"></a> &nbsp; 
                <a href="https://fond.predanie.ru/?banner=1" target="_blank"><img src="https://ekzeget.ru/IMG/partners/banner_predanie-88x31_0.gif"></a> &nbsp; 
                <a href='http://www.barysh-eparhia.ru/' target="_blank"><img src='https://ekzeget.ru/IMG/partners/banner_mini.png' width=88 height=34 title="Барышская епархия" alt='Барышская епархия'></a> &nbsp; 
                <a href="http://www.андреевский-храм.рф/" target="_blank"><img
                src="https://ekzeget.ru/IMG/partners/Banner.png"
                title="Храм апостола Андрея Первозванного" width=88 height=31 border=0></a> &nbsp; 
                <!--begin of www.hristianstvo.ru
                <a href="https://www.hristianstvo.ru/?from=13606" target="_blank"><img
                src="https://www.hristianstvo.ru/images/ru-88x31-lightgray1.gif"
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
                <a href="https://top.mail.ru/jump?from=2566972">
                <img src="//top-fwz1.mail.ru/counter?id=2566972;t=361;l=1" 
                style="border:0;" height="18" width="88" alt="Рейтинг@Mail.ru" /></a>
                <!-- //Rating@Mail.ru logo --> 
        </div>
            <div class="founder text-right"><b>&copy; С. Жидков, 2011 - 2017 гг.</b></div>
<!--/noindex-->
        </div>
</footer>
<script type="text/javascript" src="<?=$assets?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?=$assets?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=$assets?>/orphus/orphus.js"></script>
<script defer type="text/javascript" src="<?=$assets?>/js/head_scripts.js"></script><!-- все скрипты в одном -->
<!-- Rating@Mail.ru counter -->
<script defer type="text/javascript" src="<?=$assets?>/js/Rating.Mail.js"></script> 
<script type="text/javascript">
$(document).ready(function(){ 
  $("#myTab a").click(function(e){
    e.preventDefault();
    $(this).tab('show');
  });
});
</script> 
<script> 
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ 
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), 
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) 
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga'); 

ga('create', 'UA-86114429-1', 'auto'); 
ga('send', 'pageview'); 

</script> 
</body></html>