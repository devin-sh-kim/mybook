@section('style')

{{ HTML::style('js/fullcalendar/fullcalendar.css'); }}

<style>

.huge {
    font-size: 90px;
}

/*Stamp Card Panel*/
.stamp-card-panel {
	background: #4fc1e9;
	text-align: center;
	padding-bottom: 10px;
}
.stamp-card-panel #head {
	background: #a8e1ff;
	height: 100px;
	padding-top: 25px;
}

.stamp-card-panel #btn-pn {
    padding: 10px;
}

.stamp-card-panel i {
	color: white;
	margin: 10px;
}

.stamp-card-panel i.red {
    color: #bd0a0a;
}


i.stamp-calender.red {
    color: #bd0a0a;
}

i.stamp-calender.grey {
    color: grey;
}


.stamp-card-panel p {
	margin: 10px;
}
.stamp-card-panel .goal {
	color: #303030;
	font-size: 30px;
	font-weight: 900;
}

.pn {
    height: auto;
}

#complete {
	position: absolute;
	top: 10px;
	right: 20px;
	
	opacity: 0.7;
}

/* calender */
.fc-content {
	text-align : center;
	color: #000;
}

.fc-event {
	background-color: inherit;
	border: 0;
}

.fc-bgevent { /* default look for background events */
	background: #a6d7ff; /*rgb(143, 223, 130);*/
	opacity: .3;
	filter: alpha(opacity=30); /* for IE */
}

</style>

@stop



@section('content')

</style>

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-paw"></i> 도장 쾅!!</h3>
        
        <div class="row mt">
            <div class="col-lg-6 col-md-8">
            	<div class="row mb">
            		<div class="col-lg-12">
	            		<div class="pull-left">
	                    	<ul class="nav nav-pills" id="stampTab">
	                            <li class="active"><a id="tab-card" href="#context-card" data-toggle="tab">카드</a></li>
	                            <li><a id="tab-calendar" href="#context-calendar" data-toggle="tab">달력</a></li>
	                            <li><a id="link-chart" class="link" href="{{ url('/stamp/' . $stampCard->id . '/chart'); }}">챠트</a></li>
	                            <li><a id="link-goback" class="link" href="{{ url('/stamp'); }}">돌아가기</a></li>
	                        </ul>
	            		</div>
	                	<div class="pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
									Action <span class="caret"></span>
								</button>
								<ul class="dropdown-menu pull-right" role="menu">
									<li><a href="#" id="remove-last-stamp" data-id="{{ $stampCard->id }}">마지막 도장 취소</a></li>
									<li class="divider"></li>
									<li><a href="#" id="reset-stamp-card" data-id="{{ $stampCard->id }}">이 카드만 초기화</a></li>
									<li><a href="#" id="reset-stamp-all" data-id="{{ $stampCard->id }}">전체 초기화</a></li>
									<li class="divider"></li>
									<li><a href="#" id="delete-stamp" data-id="{{ $stampCard->id }}">삭제</a></li>
								</ul>
							</div>
						</div>
					</div>
                </div>

				<div class="row">
	                <div class="tab-content">
	                    <div class="tab-pane active" id="context-card">
	                	    <! -- Stamp Card Panel -->
	                	    <div class="col-lg-12">
							    <div class="stamp-card-panel pn">
							    	<div id="complete">
		                                <img src="{{ url('img/mc.png'); }}" width="180px"/>
							        </div>
							        
							        <div id="head">
						                <div class="goal">{{ $stampCard->goal }}</div>
		    					    	<div>
		    							    @if( $stampCard->end_date != '0000-00-00' )
		                                        {{ $stampCard->end_date }}까지
		                                    @endif
		                                    
		                                    @if( $stampCard->reset_type == '0' )
		                                        <!-- 반복 없음 -->
		                                    @elseif( $stampCard->reset_type == '1' )
		                                        매일
		                                    @elseif(  $stampCard->reset_type == '2'  )
		                                        매주
		                                        @if( $stampCard->reset_day == '7' )
		                                            일요일
		                                        @elseif( $stampCard->reset_day == '1' )
		                                            월요일
		                                        @elseif( $stampCard->reset_day == '2' )
		                                            화요일
		                                        @elseif( $stampCard->reset_day == '3' )
		                                            수요일
		                                        @elseif( $stampCard->reset_day == '4' )
		                                            목요일
		                                        @elseif( $stampCard->reset_day == '5' )
		                                            금요일
		                                        @elseif( $stampCard->reset_day == '6' )
		                                            토요일
		                                        @endif
		                                        시작
		                                    @elseif(  $stampCard->reset_type == '3'  )
		                                        매월 시작
		                                    @endif
		                                    (<span id="label_stamp_count">0</span>/{{ $stampCard->max_stamp_num }})
		    							</div>
									</div>
									
	                                <div id="stamps">
		    					        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2">
	                				        @for ($i = 0; $i < $stampCard->max_stamp_num; $i++)
		    									<i class="fa fa-paw fa-4x stamp-it"></i>
		                                    @endfor
			                  			</div>
									</div>
									<div id="btn-pn">
                                        <input type="hidden" id="input_value" value="{{ $stampCard->input_value }}">
										<button type="button" id="btn-stamp" class="btn btn-default btn-lg btn-block">스템프 찍기</button>	
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="context-calendar">
							<div class="col-lg-12">
								<div class="showback">
									<div id="calendar" class="has-toolbar"></div>
								</div>
							</div>
						</div>
	                </div>    
                </div>
            </div>
        </div>
    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->
<!--main content end-->


<div class="modal fade" id="inputValueModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">사용자 입력</h4>
			</div>
			<div class="modal-body">
				<input type="number" class="form-control" id="user_input_value" name="user_input_value" placeholder="저장할 수치를 입력하세요.">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
				<button type="button" class="btn btn-primary" id="btnUserInputValueSave">저장</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



@stop
@section('script')
<!-- js placed at the end of the document so the pages load faster -->
{{ HTML::script('js/jquery.js'); }}
{{ HTML::script('js/bootstrap.min.js'); }}
{{ HTML::script('js/jquery-ui-1.9.2.custom.min.js'); }}
{{ HTML::script('js/jquery.ui.touch-punch.min.js'); }}
{{ HTML::script('js/jquery.dcjqaccordion.2.7.js'); }}
{{ HTML::script('js/jquery.scrollTo.min.js'); }}
{{ HTML::script('js/jquery.nicescroll.js'); }}


{{ HTML::script('js/bootstrap-js/tab.js'); }}
{{ HTML::script('js/bootstrap-js/tooltip.js'); }}

{{ HTML::script('js/moment.js'); }}
{{ HTML::script('js/fullcalendar/fullcalendar.js'); }}

<!--common script for all pages-->

{{ HTML::script('js/common-scripts.js'); }}


<!--script for this page-->

<script>

$(function(){

    // tab
    $('#stampTab a').click(function (e) {
    
        if($(this).hasClass("link")){
            url = $(this).attr("href");
            
            window.location = url;
            return;
        }
    
        e.preventDefault()
        $(this).tab('show')
    });
    
    $('#remove-last-stamp').on('click', function(){
        stampCardId = $(this).data('id');
        //console.log(stampCardId);
        
        $.ajax("{{ url('/stamp/' . $stampCard->id . '/last'); }}", {'method': 'DELETE'})
            .done(function(data){
                stampIt(data, {{ $stampCard->max_stamp_num }});
            });
    });

	// card
	$("#complete").hide();
	
	$('#btnUserInputValueSave').click(function(){
		$.get("{{ url('stamp/' . $stampCard->id . '/add'); }}?value=" + $('#user_input_value').val(), 
			function( data ) {
  				stampIt(data, {{ $stampCard->max_stamp_num }});
  				$('#inputValueModal').modal('hide');
			});
	});
            

    $("#btn-stamp").click(function(){
        if($('#input_value').val() == 'Y'){
            console.log('INPUT VALUE');
            
            $('#user_input_value').val("");
            
            $('#inputValueModal').modal('show');
            
        }else{
    	$.get("{{ url('stamp/' . $stampCard->id . '/add'); }}", 
    		function( data ) {
  				//alert(data);
  				stampIt(data, {{ $stampCard->max_stamp_num }});
			});
        	
        }
    });
    


    // calender
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        //e.target; // 활성화된 탭
    	if(e.target.id == 'tab-calendar'){
    
		    $('#calendar').fullCalendar({
				
				header: {
					//left: 'prev,next today',
					//center: 'title'
					//right: 'month,agendaWeek,agendaDay'
				},
				
				editable: false,
				//eventLimit: true, // allow "more" link when too many events
				events: {
					url: '{{ url("stamp/" . $stampCard->id . "/calendar.json") }}'
				},
				eventRender: function(event, element) {
					console.log(event);
					console.log(element);
				 	// get your new title somehow
			 	    var title = '<i class="fa fa-paw fa-4x stamp-calender red"></i><br>x' + event.title;    
				 	// replace the event title
				 	element.find('.fc-title').html( title );
				 	
				 	event.title = title;
				},
				
				//height : 700,
				contentHeight: 600
			});

        	$('#calendar').fullCalendar('refetchEvents');
//            $('#calendar').fullCalendar('render');
        
        }
        
        //e.relatedTarget; // 이전 탭
    });
    
    // stamp Load
    stampIt({{ $stampCard->stamp_count }}, {{ $stampCard->max_stamp_num }});

	// action
	

});


function stampIt(n, max){
    $("#complete").hide();
    $("#btn-stamp").prop("disabled", "");
	$("#btn-stamp").text('스템프 찍기');

    $("#label_stamp_count").html(n);

	$("i.stamp-it").each( function( index ){
		if(index < n){
			$(this).addClass('red');
		}else{
		    $(this).removeClass('red');
		}
	});
	
	if(n >= max){
		$("#btn-stamp").prop("disabled", "disabled");
		$("#btn-stamp").text('미션 성공');
		
		$("#complete").fadeIn('slow');
	}
}

</script>
@stop