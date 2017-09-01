<?php

use services\URLS;
$this->setTitle("Экзегеты");
?>
<div class="news-list">
    <h3>Экзегеты, чьи толкования представлены на нашем сайте</h3>
    <hr class="ekz">
<div class="row">
<div class="col-md-8 text-right"><p>быстрый поиск:</p></div>
<div class="col-md-4"><input type="text" ng-model="member" class="form-control search_page text-left"></div>
</div>

<div class="loading"></div>
                        <ol class="news ekzegets disable">

<li ng-repeat="item in myData.authors | filter:{Name:member}">
    <h4><a href="/commentary/author/{{item.Slug}}/">{{item.Name}}</a></h4>
</li>


</ol>
</div>