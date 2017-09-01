<div id="loading" class="loading"></div>
<div class="news-list disable">
<hr class="ekz">
                        <ul class="news">
<li ng-repeat="item in myData.dictionaries"> <h4><a class="a-ng" ng-click="getAlphabet(item.Slug)">{{item.Name}}
</a></h4>
</li>
<li ng-repeat="item in mySecond.dictionaries"> <h4><a class="a-ng" style="font-size: 16px;" ng-click="getAlphabet(item.Slug)">{{item.Name}}
</a></h4>
</li>

</ul>
</div>
<div class="alphabet-list disable">
<hr class="ekz">
                        <ul class="ekzegets">
<li ng-repeat="item in myAlphabet.letters"> <h4><a class="a-ng" ng-click="getWord(item.Slug)">{{item}}
</a></h4>
</li>


</ul>
</div>