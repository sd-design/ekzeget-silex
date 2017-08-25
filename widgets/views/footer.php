<?php
use services\URLS;
use widgets\Footer;

?>

<footer class="footer_pano">
<!--noindex-->
<div id="message">
<a id="toTop" href="#"><img src="<?=$base_url?>/assets/IMG/vverh.png" /></a></div>
<div class="container">
        <div class="footer-menu">
            <div class="row">
                <div class="col-md-3"><a href="/.."><img src="<?=$base_url?>/assets/IMG/logo.png" class="logo-bottom" title="Экзегет. Библия и толкования"></a></div>
                <div class="col-md-6">
                    <a href="<?=$base_url?>/rules/"> Правила</a> |
                    <a href="<?=$base_url?>/new_tolk/">Обновления</a> |
                    <a href="<?=$base_url?>/generator/"> Генератор ссылок</a> |
                    <a href="<?=$base_url?>/search/"> Поиск</a> |
                    <a href="<?=$base_url?>/zap/"> Гостевая</a> <br />
                    <a href="<?=$base_url?>/sermon/">Проповеди</a> |
                    <a href="<?=$base_url?>/dictionary/">Словари</a> |
                    <a href="<?=$base_url?>/maps/"> Карты</a> |
                    <a href="<?=$base_url?>/commentary/"> Экзегеты</a> |
                    <a href="<?=$base_url?>/lektorij/"> Лекторий</a> | <a href="https://pda.ekzeget.ru/">Мобильная версия</a>
                    </div>
                    <div class="col-md-3 text-right">
                        <a href="<?=$base_url?>/donation/" class="btn btn-lg btn-donation">Пожертвовать</a>     
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
<script type="text/javascript" src="<?=$assets?>/js/general_menu.js"></script>
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