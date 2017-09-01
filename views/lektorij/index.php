<ul class="nav nav-tabs" id="myTabs" role="tablist">
<li role="presentation" class="active"><a href="#about-bible" id="bible-tab" role="tab" data-toggle="tab" aria-controls="about-bible" aria-expanded="true">О Библии</a></li>
<li role="presentation" class=""><a href="#church" role="tab" id="church-tab" data-toggle="tab" aria-controls="church" aria-expanded="false">Библия в жизни Церкви</a></li>
<li role="presentation" class=""><a href="#etc" role="tab" id="etc-tab" data-toggle="tab" aria-controls="etc" aria-expanded="false">Дополнительно</a></li>
</ul>
<div class="loading"></div>
<div class="tab-content disable" id="myTabContent" ng-controller="LekController">
        <div class="tab-pane fade in active" role="tabpanel" id="about-bible" aria-labelledby="bible-tab"> 
                <ul class="news">
                        <li ng-repeat="item in myTab1.pages"><h4><a href="/lektorij/{{item.Code}}">{{item.Title}}</a></h4></li>
                        
                </ul>
        </div>

        <div class="tab-pane fade" role="tabpanel" id="church" aria-labelledby="church-tab">
                        <ul class="news">
                        <li ng-repeat="item in myTab2.pages"><h4><a href="/lektorij/{{item.Code}}">{{item.Title}}</a></h4></li>
                        </ul>
        </div>

        <div class="tab-pane fade" role="tabpanel" id="etc" aria-labelledby="etc-tab">
                        <ul class="news">
                        <li ng-repeat="item in myTab3.pages"><h4><a href="/lektorij/{{item.Code}}">{{item.Title}}</a></h4></li>
                                </ul>
        </div>
</div>