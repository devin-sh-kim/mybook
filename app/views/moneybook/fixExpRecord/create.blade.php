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
					<h4>고정 비용 관리</h4>

					{{ Form::open(array('url' => url('/fixExpRecord'), 'class' => 'form-horizontal style-form')) }}
                        
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
                        
                        
                        
                        <button type="submit" class="btn btn-primary btn-lg btn-block">저장</button>
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


$(function(){

});


</script>
@stop