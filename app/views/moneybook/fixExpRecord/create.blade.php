@section('style')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
@stop

@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-money"></i> Money Book</h3>

		<div class="row mt">
			<div class="col-lg-12">
				<div class="showback">
					<h4>고정 비용 등록</h4><hr>
					{{ Form::open(array('url' => url('/fixExpRecord'), 'class' => 'form-horizontal style-form', 'data-async')) }}
                        <div class="form-group">
                            {{ Form::label('type', '수입/지출', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="type" id="record_type_inc" value="INC">수입
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="type" id="record_type_out" value="OUT">지출
                                            </label>
                                		</div>
     								</div>
						       </div>
							</div>
						</div>
                        
                        <div class="form-group">
                            {{ Form::label('attach', '반복 주기', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-8">
                                <div class="row">
									
									<div class="col-sm-12">
										<div class="btn-group btn-group-justified" data-toggle="buttons">
											<label class="btn btn-default">
												<input type="radio" name="cycle_type" id="cycle_type_year" value="Y">매년
											</label>
											<label class="btn btn-default">
												<input type="radio" name="cycle_type" id="cycle_type_month" value="M">매월
											</label>
											
											<label class="btn btn-default disabled">
												<input type="radio" name="cycle_type" id="cycle_type_week" value="W">매주
											</label>
											<label class="btn btn-default disabled">
												<input type="radio" name="cycle_type" id="cycle_type_day" value="D">매일
											</label>
											
										</div>
									</div>
								</div>
								<div id="yearly" class="cycle-detail">
									<div class="row" style="padding-top: 10px;">
                                        <div class="col-sm-12">
											{{ Form::select('cycle_yearly_month', array(
												'1' => '1월',
												'2' => '2월', 
												'3' => '3월', 
												'4' => '4월', 
												'5' => '5월', 
												'6' => '6월', 
												'7' => '7월', 
												'8' => '8월', 
												'9' => '9월', 
												'10' => '10월', 
												'11' => '11월', 
												'12' => '12월', 
											), '1', array('class' => 'form-control')); }}
										</div>
									</div>
									<div class="row" style="padding-top: 10px;">
                                        <div class="col-sm-12">
											{{ Form::select('cycle_yearly_day', array(
												'1' => '1일',
												'2' => '2일', 
												'3' => '3일', 
												'4' => '4일', 
												'5' => '5일', 
												'6' => '6일', 
												'7' => '7일', 
												'8' => '8일', 
												'9' => '9일', 
												'10' => '10일', 
												'11' => '11일', 
												'12' => '12일', 
												'13' => '13일', 
												'14' => '14일', 
												'15' => '15일', 
												'16' => '16일', 
												'17' => '17일', 
												'18' => '18일', 
												'19' => '19일', 
												'20' => '20일', 
												'21' => '21일', 
												'22' => '22일', 
												'23' => '23일', 
												'24' => '24일', 
												'25' => '25일', 
												'26' => '26일', 
												'27' => '27일', 
												'28' => '28일', 
		                 					), '1', array('class' => 'form-control')); }}
                  						</div>
                  					</div>
                                </div>
                                <div id="monthly" class="cycle-detail">
                                    <div class="row" style="padding-top: 10px;">
                                        <div class="col-sm-12">
                                            {{ Form::select('cycle_monthly_day', array(
												'1' => '1일',
												'2' => '2일',
												'3' => '3일',
												'4' => '4일',
												'5' => '5일',
												'6' => '6일',
												'7' => '7일',
												'8' => '8일',
												'9' => '9일',
												'10' => '10일',
												'11' => '11일',
												'12' => '12일',
												'13' => '13일',
												'14' => '14일',
												'15' => '15일',
												'16' => '16일',
												'17' => '17일',
												'18' => '18일',
												'19' => '19일',
												'20' => '20일',
												'21' => '21일',
												'22' => '22일',
												'23' => '23일',
												'24' => '24일',
												'25' => '25일',
												'26' => '26일',
												'27' => '27일',
												'28' => '28일', 
											), '1', array('class' => 'form-control')); }}
                                        </div>
                                    </div>
                                </div>
                                <div id="weekly" class="cycle-detail">
                                    <div class="row" style="padding-top: 10px;">                                    
                                        <div class="col-sm-12">                                        
                                            <div class="btn-group btn-group-justified" data-toggle="buttons">
                                            	<label class="btn btn-default" id="cycle_weekly_sun">
        											<input type="radio" name="cycle_weekly" value="7">일
      											</label>
      											<label class="btn btn-default" id="cycle_weekly_mon">
        											<input type="radio" name="cycle_weekly" value="1">월
    											</label>
    											<label class="btn btn-default" id="cycle_weekly_tue">    												
    												<input type="radio" name="cycle_weekly" value="2">화
    											</label>
    											<label class="btn btn-default" id="cycle_weekly_wed">
    												<input type="radio" name="cycle_weekly" value="3">수
    											</label>
    											<label class="btn btn-default" id="cycle_weekly_thu">
    												<input type="radio" name="cycle_weekly" value="4">목
    											</label>
    											<label class="btn btn-default" id="cycle_weekly_fri">
    												<input type="radio" name="cycle_weekly" value="5">금
    											</label>
    											<label class="btn btn-default" id="cycle_weekly_sat">
    												<input type="radio" name="cycle_weekly" value="6">토
    											</label>
    										</div>
    									</div>
    								</div>
								</div>
							</div>
						</div>
                        
    					<div class="form-group">
                            {{ Form::label('context', '내역', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-8">
                                {{ Form::text('context', '', array('class' => 'form-control', 'placeholder' => '내역을 입력하세요')); }}
                            </div>
                        </div>
                 
                        <div class="form-group">
                            {{ Form::label('value', '금액', array('class' => 'col-sm-2 control-label')); }}          
                            <div class="col-sm-8">
								{{ Form::text('value', '', array('class' => 'form-control number', 'min' => '1', 'placeholder' => '금액을 입력하세요', 'id'=>'value', 'onkeypress'=>'validate(event)' , 'style'=>'text-align:right;')); }}
                	        </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('start_at', '시작일', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="start_at" id="start_at">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label('end_at', '종료일', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-8">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">
                                        <input type="checkbox" id="end_at_able">
                                    </span>
                                    <input type="date" class="form-control" name="end_at" id="end_at" disabled="disabled">
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">저장</button>
                    {{ Form::close() }}		
					
				</div>
			</div>
		</div>
		
    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->
<!--main content end-->


@stop
@section('script')
<!-- js placed at the end of the document so the pages load faster -->
{{ HTML::script('js/jquery.js'); }}
{{ HTML::script('js/bootstrap.min.js'); }}
<!--
{{ HTML::script('js/bootstrap-js/modal.js'); }}
-->
{{ HTML::script('js/jquery-ui-1.9.2.custom.min.js'); }}
{{ HTML::script('js/jquery.ui.touch-punch.min.js'); }}
{{ HTML::script('js/jquery.dcjqaccordion.2.7.js'); }}
{{ HTML::script('js/jquery.scrollTo.min.js'); }}
{{ HTML::script('js/jquery.nicescroll.js'); }}


<!--common script for all pages-->
{{ HTML::script('js/common-scripts.js'); }}

<!--script for this page-->

<script>

function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}


$(function(){

	$( '.cycle-detail' ).hide();

	$("[name='cycle_type']").change(function (){
		$( '.cycle-detail' ).hide();

	    if( $(this).val() == 'Y' ){
	    	$( '#yearly' ).fadeIn();
	    }else if( $(this).val() == 'M' ){
	    	$( '#monthly' ).fadeIn();
	    }else if( $(this).val() == 'W' ){
	    	$( '#weekly' ).fadeIn();
	    }
	});

    $( '#end_at_able' ).change(function (){
		if( $( '#end_at_able' ).prop( "checked" ) ){
			$( '#end_at' ).prop("disabled", "");
		}else{
			$( '#end_at' ).prop("disabled", "disabled");
		}
	});

	$('input.number').keyup(function(event) {

        // skip for arrow keys
        if(event.which >= 37 && event.which <= 40){
            event.preventDefault();
        }
        
        $(this).val(function(index, value) {
            value = value.replace(/,/g,''); // remove commas from existing input
            return numberWithCommas(value); // add commas back in
        });
    });


});


</script>
@stop