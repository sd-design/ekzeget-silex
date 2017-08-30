<!-- calendula -->
<div class="calendar_inside">
                    <div id ="chten" ng-controller="CalendarController">
                            <div id="response">
<div class="icon-calendar"><a id="toggler" title="Перейти на любую дату чтения"><img src="<?=$assets?>/IMG/day.png"/ ></a>
</div>
<div id="answer" style="display: none;">Введите дату богослужебных чтений:<br /> <input type="date" id="data_today" ng-model="myInput.day" maxlength="15" pattern="\d+.+" placeholder="гггг.мм.дд">     <button type="submit" ng-click="SendCal();" name="submit" style="padding: 6px 8px 5px 8px;font-size: 11px;">OK</button>
</div>
<div id="chten_today"><b><span id="today_cal">СЕГОДНЯ </span>
        <span style="color: #DF0404; ">{{myCal.seg}}</span></b></div>
<div id="page_content3" class="scroll-pane1">
                <div><span class="nazv">{{myCal[0].nazvan}}</span></div>
                <div><span><b>Литургия:</b> Ап.: <span>{{myCal[0].apost_cht}}</span><br/>
                Ев.: <span>{{myCal[0].evang_cht}}</span>
            </div>
                                <!-- end ajax block -->
                   
</div>  
                    <div id="zavtr_chten"><input id="dat_send" type="hidden" ><a ng-click="SendRequest2(myCal.befor);" rel="nofollow" title="Предыдущий день" data="{{myCal.befor}}">&#8592; Пред.</a> <span style="color: #c4c4c4;">|</span> <a style="color: #c4c4c4; cursor: text;text-decoration: none;">Сегодня</a> <span style="color: #c4c4c4;">|</span> <a ng-click="SendRequest2(myCal.next);" rel="nofollow" title="Следующий день" data="{{myCal.next}}">След. &#8594;</a>
                    </div>
            </div>
        </div>
    </div>
<!-- end Calendula -->