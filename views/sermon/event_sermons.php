<?php
/**
 * @var \Application $app
 * @var Commentaries $this
 * @var \Propel\Runtime\Collection\Collection|\models\Tradition[] $commentaries
 * @var string $assets
 * @var boolean $isResearch
 * @var string $bookCode
 * @var integer $chapterNum
 */
use services\URLS;

?>
<div class="loading"></div>
<div id="osn_text" class="disable">
<h2>Апостол:</h2>
<hr class="ekz">
<h5>{{myApostol.book[0]}}</h5>
<ul class="bible-poem-text">
<li class="fulltext" ng-repeat="item in myApostol.passages | filter:item.abbreviation ='st_text'">
<a href="{{item.pointer}}"><sup>{{item.NumStih*1}}</sup><span>{{item.contents}}</span></a>
</li>
</ul>
<h2>Евангелие:</h2>
<hr class="ekz">
<h5>{{myEvng.book[0]}}</h5>
<ul class="bible-poem-text">
<li class="fulltext" ng-repeat="item in myEvng.passages | filter:item.abbreviation ='st_text'">
<a href="{{item.pointer}}"><sup>{{item.NumStih*1}}</sup><span>{{item.contents}}</span></a>
</li>
</ul>
<h2>Проповеди:</h2><hr>
            <ol class="list-sermon">
<li ng-repeat="item in myData.sermons">
<sup></sup><span><a href="/sermon/{{item.id}}/author/{{item.author_slug}}/"><span>{{item.author_name}}</span> <span>&#171;{{item.topic}}&#187;</span></a></li>
</ol>
</div>