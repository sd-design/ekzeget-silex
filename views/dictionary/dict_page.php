<div class="loading"></div>
<div class="news-list disable">
<hr class="ekz">
                        <ul class="news">
<li ng-repeat="item in myData.dictionaries"> <h4><a style="font-size: 16px;" href="/dictionary/{{item.Slug}}/">{{item.Name}}
</a></h4>
</li>
<li ng-repeat="item in mySecond.dictionaries"> <h4><a style="font-size: 16px;" href="/dictionary/{{item.Slug}}/">{{item.Name}}
</a></h4>
</li>

</ul>
</div>