@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-paw"></i> 도장 쾅!!</h3>
        
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4><i class="fa fa-angle-right"></i> 카드 만들기</h4>
                    {{ Form::open(array('url' => 'stamp', 'class' => 'form-horizontal style-form')) }}
                        
                        <div class="form-group">
                            {{ Form::label('goal', '목표', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-8">
                                {{ Form::text('goal', '', array('class' => 'form-control', 'placeholder' => '목표를 설정하세요')); }}
                                {{ Form::checkbox('input_value', 'Y', false, array('id' => 'input_value')); }}
                                {{ Form::label('input_value', '수치 입력 가능', array('class' => 'control-label')); }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label('max_stamp_num', '목표 스탬프', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-8">
                                {{ Form::number('max_stamp_num', '', array('class' => 'form-control', 'min' => '1', 'placeholder' => '목표 스탬프 갯수를 입력하세요')); }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label('attach', '신규 발행', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-8">
                                <div class="row">
                     	
                                    <div class="col-sm-12">
                                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                                            <label class="btn btn-default">
                                                <input type="radio" name="reset_type" id="reset_type_none" value="0">없음
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="reset_type" id="reset_type_daily" value="1">매일
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="reset_type" id="reset_type_weekly" value="2">매주
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="reset_type" id="reset_type_monthly" value="3">매월
                                            </label>
                                		</div>
                                	</div>
                                </div>
                                <div id="weekly">
                                    <div class="row" style="padding-top: 10px;">
                                    <input type="hidden" name="reset_weekly" id="reset_weekly_input" />
                                        <div class="col-sm-12">
                                            <div class="btn-group btn-group-justified" data-toggle="buttons">
                                            	<label class="btn btn-default" id="reset_weekly_sun">
        											<input type="radio" name="reset_weekly" value="7">일
      											</label>
      											<label class="btn btn-default" id="reset_weekly_mon">
        											<input type="radio" name="reset_weekly" value="1">월
    											</label>
    											<label class="btn btn-default" id="reset_weekly_tue>
    												<input type="radio" name="reset_weekly"" value="2">화
    											</label>
    											<label class="btn btn-default" id="reset_weekly_wed">
    												<input type="radio" name="reset_weekly" value="3">수
    											</label>
    											<label class="btn btn-default" id="reset_weekly_thu">
    												<input type="radio" name="reset_weekly" value="4">목
    											</label>
    											<label class="btn btn-default" id="reset_weekly_fri">
    												<input type="radio" name="reset_weekly" value="5">금
    											</label>
    											<label class="btn btn-default" id="reset_weekly_sat">
    												<input type="radio" name="reset_weekly" value="6">토
    											</label>
    										</div>
    									</div>
    								</div>
								</div>
							</div>
						</div>
                        <div class="form-group">
                            {{ Form::label('end_date', '종료일', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-8">
                                <div class="input-group input-group-sm">
                                    <span class="input-group-addon">
                                        <input type="checkbox" id="end_date_able">
                                    </span>
                                    <input type="date" class="form-control" name="end_date" id="end_date" disabled="disabled">
                                </div>
		                    </div>
                        </div>
                            
                        <div class="form-group">
                            
                            <div class="col-sm-8">
                                
                            
                        </div>       </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">Create Stamp Card</button>
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
{{ HTML::script('js/jquery-ui-1.9.2.custom.min.js'); }}
{{ HTML::script('js/jquery.ui.touch-punch.min.js'); }}
{{ HTML::script('js/jquery.dcjqaccordion.2.7.js'); }}
{{ HTML::script('js/jquery.scrollTo.min.js'); }}
{{ HTML::script('js/jquery.nicescroll.js'); }}


<!--common script for all pages-->
{{ HTML::script('js/common-scripts.js'); }}

<!--script for this page-->
{{ HTML::script('js/bootstrap-js/button.js'); }}

<script>

$(function(){
	
	$( '#weekly' ).hide();
	
	$("[name='reset_type']").change(function (){
		
	    if( $(this).val() == '2' ){
	    	$( '#weekly' ).fadeIn();
	    }else{
	    	$( '#weekly' ).fadeOut();
	    }
	});
	
	$( '#end_date_able' ).change(function (){
		if( $( '#end_date_able' ).prop( "checked" ) ){
			$( '#end_date' ).prop("disabled", "");
		}else{
			$( '#end_date' ).prop("disabled", "disabled");
		}
	});
	
});


</script>
@stop