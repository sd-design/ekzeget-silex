<?php
use services\URLS;
use widgets\Navmenu;
use widgets\RegularVisitor;
use widgets\RegistrationInvitation;


?>
 
 <nav class="navbar navbar-default">
 <div class="navbar-header">
                <ul class="nav navbar-nav">
                    <li><a href="<?=$base_url?>/page/o_proekte/"><div class="tehnav" style="padding-left:0"> О проекте</div></a></li>
                    <li><a href="<?=$base_url?>/page/updates/"><div class="tehnav"> Обновления </div></a></li>
                    <li><a href="<?=$base_url?>/generator/"><div class="tehnav">Генератор ссылок</div></a></li>
                    <li><a href="<?=$base_url?>/zap/"><div class="tehnav"> Гостевая </div></a></li>
                </ul>
            
        </div>
        <div class="navbar-right">
              <div class="nav_verh">
              <?php
              if (!$app['session']->get('loggedin')) {
                echo 'Здравствуйте, <b>Гость</b> | <a href="'.$base_url.'/auth/login">Вход</a> | <a href="'.$base_url.'/registration/">Регистрация</a>';
              }
              echo RegularVisitor::widget(['top' => 240]);
              echo RegistrationInvitation::widget();
              ?>
        </div>
        </div>

</nav>