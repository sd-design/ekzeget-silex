<!-- calendula -->
<div ng-controller="CalendarController">
<div id="page_content3" class="scroll-pane1">
                <div><span class="nazv">{{myCal[0].nazvan}}</span></div>
                <div><span><b>Литургия:</b> Ап.: <span>{{myCal[0].apost_cht}}</span><br/>
                Ев.: <span>{{myCal[0].evang_cht}}</span>
            </div>
                                <!-- end ajax block -->
                   
</div>  
                    <div id="zavtr_chten"><input id="dat_send" type="hidden" ><a onclick="SendRequest2();" rel="nofollow" title="Предыдущий день" data-cal="{{myCal.befor}}">&#8592; Пред.</a> <span style="color: #c4c4c4;">|</span> <a style="color: #c4c4c4; cursor: text;text-decoration: none;">Сегодня</a> <span style="color: #c4c4c4;">|</span> <a onclick="SendRequest2();" rel="nofollow" title="Следующий день" data-cal="{{myCal.next}}">След. &#8594;</a>
                    </div>
</div>
<!-- end Calendula -->