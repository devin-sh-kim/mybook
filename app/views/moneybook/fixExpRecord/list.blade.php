@section('style')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
@stop

@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
		<div class="row mt">
			<div class="col-lg-12">
				<div class="showback">
					<h4>고정 비용 관리</h4>
					<table id="records" class="row-border" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>종류</th>
                                <th>주기</th>
                                <th>내역</th>
								<th>금액</th>
								<!--<th>Balance</th>-->
							</tr>
						</thead>
					</table>
			
					<div class="row mt">
						<div class="col-lg-12">
							<button type="button" class="btn btn-primary btn-block" id="btnWriteRecord">등록</button>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->
<!--main content end-->


<!-- Modal -->
<div class="modal fade" id="writeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">등록</h4>
			</div>
			<div class="modal-body">
				<div>
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
                        <button type="submit" class="btn btn-primary btn-lg btn-block">저장</button>
                    {{ Form::close() }}			
				
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



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
{{ HTML::script('//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js'); }}
<!--script for this page-->

<script>

var table;

function writeRecordModel(){
	
	$( '.cycle-detail' ).hide();

    $('#writeModal').modal('show');
    
}

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

	table = $('#records').DataTable( {
        "ajax": '{{ url("/fixExpRecord.json"); }}',
        "ordering": false,
        "paging": false,
        "info": false,
        "searching": false,
        "columnDefs": [
    		{ "targets": 0, "width": "60"},
    		{ "targets": 1, "width": "100"},
    		{ "targets": 2, "width": "auto"},
    		{ "targets": 3, "width": "100"}
  		],
  		"columns": [
            { "data": "type_name"		, "className": "dt-center" },
            { "data": "cycle_disp"		, "className": "dt-head-center dt-body-center details-control" },
            { "data": "context"			, "className": "dt-head-center dt-body-left" },
            { "data": "value_disp"		, "className": "dt-head-center dt-body-right value" }
        ],
  		"fnCreatedRow": function( nRow, aData, iDataIndex ) {
  			//console.log(aData);
			if ( aData['type_name'] == "지출" )
			{
				$('td', nRow).css('color', '#9e0000');
			}else{
				$('td', nRow).css('color', '#0012b8');
			}
	    }
    });

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
	

	$('#btnWriteRecord').on('click', function(){
        writeRecordModel();
    });
    
    $('form[data-async]').on('submit', function(event) {
        var $form = $(this);
        var $target = $($form.attr('data-target'));
 
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize()
        }).done(function(data, textStatus, jqXHR){
            //console.log(textStatus);
            //location.reload();
            table.ajax.reload();
            $('#writeModal').modal('hide');
        }).fail(function(jqXHR, textStatus, errorThrown){
            console.log(textStatus);
        });
 
        event.preventDefault();
    });
	
});


</script>
@stop