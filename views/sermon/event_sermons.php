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

<hr class="ekz">
<div id="osn_text">
<ul class="bible-poem-text">
<li ng-repeat="item in myData.pointers"><span>
                </span><a href="{{item.PointerFrom}}"><span>{{item.PointerFrom}} - {{item.PointerTo}}</span></a>

</ul>
            <ol class="bible-poem-text">
<li ng-repeat="item in myData.sermons"><sup></sup><span><a href="/sermon/{{item.id}}/author/{{item.author_slug}}/"><span>{{item.author_name}}</span> <span>&#171;{{item.topic}}&#187;</span></a>

</ul>
</div>