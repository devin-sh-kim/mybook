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
					<h4>Money Book 설정</h4>

					{{ Form::open(array('url' => url('/moneybook-setting'), 'class' => 'form-horizontal style-form')) }}
                        
                        <div class="form-group">
                            {{ Form::label('startDay', '시작 일', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-10">
                                {{ Form::select('startDay', array(
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
                                	), $setting->startDay, array('class' => 'form-control')); }}
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