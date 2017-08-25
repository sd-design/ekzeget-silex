<?php

use services\URLS;
$this->setTitle("Экзегеты");
?>
<div class="news-list">
    <h3>Экзегеты, чьи толкования представлены на нашем сайте</h3>
<hr class="ekz">
<div class="loading"></div>
                        <ol class="news ekzegets disable">

<li ng-repeat="item in myData.authors">
    <h4><a href="/commentary/author/{{item.Slug}}/">{{item.Name}}</a></h4>
</li>


</ol>
</div>