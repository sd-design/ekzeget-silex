<!-- calendula -->
<div ng-controller="CalendarController">
<div id="page_content3" class="scroll-pane1">
                <div><span class="nazv">{{myCal.nazvan}}</span></div>
                <div><span><b>Литургия:</b> Ап.: <span>{{myCal.apost_cht}}</span><br/>
                Ев.: <span>{{myCal.evang_cht}}</span>
            </div>
                                    <!-- end ajax block -->
                   
</div>  
                    <div id="zavtr_chten"><input id="dat_send" type="hidden"><a onclick="$('#dat_send').attr('value', '{{myCal.befor}}'); SendRequest();" rel="nofollow" title="Предыдущий день">&#8592; Пред.</a> <span style="color: #c4c4c4;">|</span> <a style="color: #c4c4c4; cursor: text;text-decoration: none;">Сегодня</a> <span style="color: #c4c4c4;">|</span> <a onclick="$('#dat_send').attr('value', '{{myCal.next}}');SendRequest();" rel="nofollow" title="Следующий день">След. &#8594;</a>
                    </div>
</div>
<!-- end Calendula -->