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
<!DOCTYPE html><html lang="ru" ng-app="bible"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta name="keywords" content="Библия Онлайн, толкование Священного Писания, переводы Библии, планы чтения Библии, Евангелие, аудиобиблия, слушать Библию, Библейские карты" />
<meta name="description" content="Библия от «А» до «Я»: тексты Священного Писания в оригинале, и в различных переводах, толкования Отцов Церкви и современных богословов, исторические комментарии и справочники, интерактивные путешествия во времени и пространстве, аудиокниги и лекции. Ekzeget.ru - ваш проводник в мир Библии" /><meta property="og:image" content="<?=$assets?>/IMG/soc_kniga.png" />
<link rel="image_src" href="/IMG/soc_kniga.png" /><link rel="apple-touch-icon" href="<?=$assets?>/IMG/soc_kniga.png" /><link rel="apple-touch-icon" href="<?=$assets?>/IMG/soc_kniga60x60.png" size="60x60" /><link rel="apple-touch-icon" href="<?=$assets?>/IMG/soc_kniga76x76.png" size="76x76" /><link rel="apple-touch-icon" href="<?=$assets?>/IMG/soc_kniga120x120.png" size="120x120" /><link rel="apple-touch-icon" href="<?=$assets?>/IMG/soc_kniga152x152.png" size="152x152" />
<title><?=$page_title?> | Ekzeget.ru - ваш проводник в мир Библии</title>
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
    <?= \widgets\Navmenu::widget()?>

<div class="jumbotron">
    <div class="row">
    <div class="col-md-4"><!-- Календарь -->
    <!--noindex-->
<?= \widgets\Calendula::widget()?>

<!--/noindex-->  
    </div>
        <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6"><a href = "/.."><img src="<?=$assets?>/IMG/logo.png" style="height:70px; margin-left: 45px; margin-top: 2px" title="Экзегет. Библия и толкования" /></a></div>
                    <div class="col-md-6">
                        <div class="rss">
                        <a href="https://vk.com/ekzeget" target="_blank" title="Мы ВКонтакте">
                        <img style="margin: 0 5px 0 0" src="<?=$assets?>/IMG/vk.png" /></a> 
                        <a href="https://www.facebook.com/groups/ekzeget/" target="_blank" title="Мы на Facebook'e">
                        <img style="margin: 0 5px 0 0" src="<?=$assets?>/IMG/f.png" /></a> 
                        <a href="https://twitter.com/EkzegetRU" target="_blank" title="Мы в твиттере">
                        <img style="margin: 0 5px 0 0" src="<?=$assets?>/IMG/tvit.png" /></a>
                        <a href="https://www.youtube.com/channel/UCymsjx24eU3kRFUjeBsh47A" target="_blank" title="Наш канал на YouTube">
                        <img style="margin: 0 5px 0 0" src="<?=$assets?>/IMG/youtube.png"></a>
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
<?= \widgets\GeneralMenu::widget()?>
                    </div>
                </div>
        </div>
    </div>
     
</div>
    </div>
</section>
<section id="ekzeget">
    <div class="container"><h1><?=$page_title?></h1></div>
</section>

<section id="page">
<div class="container">
    <div class="row">
        <!--левый блок -->
        <div class="col-sm-3">
             <!--noindex-->
        <!-- НАЧАЛО МЕНЮ карт-->
        <br/>
        <div class="pano-banners calendar_inside box2 text-left">
        <div class="maps-menu" id="maps-menu">    <a href="map.php?map=1">
        <hr>
            <span>1. Физическая карта святой земли</span>
            </a><br>
        
            <a href="map.php?map=2">
            <span>2. Исход Израиля из Египта и вхождение в Ханаан</span>
            </a><br>
        
            <a href="map.php?map=3">
            <span>3. Разделение на 12 колен</span>
            </a><br>
        
            <a href="map.php?map=4">
            <span>4. Империя Давида и Соломона</span>
            </a><br>

        
            <a href="map.php?map=5">
            <span>5. Ассирийская Империя</span>
            </a><br>

        
            <a href="map.php?map=6">
            <span>6. Ново-вавилонская империя</span> (Навуходоносор) <span>и царство Египетское</span>
            </a><br>

        
            <a href="map.php?map=7">
            <span>7. Персидская империя</span>
            </a><br>

        
            <a href="map.php?map=8">
            <span>8. Римская империя</span>
            </a><br>

        
            <a href="map.php?map=9">
            <span>9. Мир Ветхого Завета</span>
            </a><br>

        
            <a href="map.php?map=10">
            <span>10. Ханаан во времена Ветхого Завета</span>
            </a><br>

        
            <a href="map.php?map=11">
            <span>11. Святая земля во времена Нового Завета</span>
            </a><br>

        
            <a href="map.php?map=12">
            <span>12. Иерусалим во дни Иисуса</span>
            </a><br>

        
            <a href="map.php?map=13">
            <span>13. Миссионерские путешествия апостола Павла</span>
            </a><br>

        
            <a href="map.php?map=14">
            <span>14. Святая земля: карта высот в библейские времена</span>
            </a><br><hr>
</div>
        </div>
   
       
       
        <!--/noindex-->
       
        </div>
        <!--центральный блок -->
        <div class="col-md-9 page-control">
            <div class="page-content">
   
            <?=$contents?>
            
                     
            </div>
        </div>
        <!--правый блок в картах убрали-->
     
   
</div>
</section>
<?= \widgets\Footer::widget()?>