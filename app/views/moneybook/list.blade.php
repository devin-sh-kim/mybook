@section('style')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.4/css/jquery.dataTables.min.css">
{{ HTML::style('css/bootstrap-select.css'); }}

<style type="text/css">

table.dataTable .record {
    padding-top: 6px;
    padding-bottom: 6px;
    padding-left: 0px;
    padding-right: 0px;
}

table.dataTable .record.pd {
    padding-top: 6px;
    padding-bottom: 6px;
    padding-left: 10px;
    padding-right: 10px;
}

table#total td.value {
    text-align: right;
}
</style>

@stop

@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-money"></i> Money Book</h3>
        
		
		<div class="row mt">
			<div class="col-lg-12">
				<div class="showback">
				    <div class="row">
    				    <div class="col-xs-6">
    					    <h4>{{ $range['start'] . " ~ " . $range['end'] }}</h4>
    					</div>
    					<div class="col-xs-6">
                            <div class="btn-group btn-group-sm pull-right">
                                <a href="{{ url('/moneybook?y=' . $range['prev_year'] . '&m=' . $range['prev_month']) }}" class="btn btn-default"><i class="fa fa-angle-left"></i></a>
                                <a href="{{ url('/moneybook') }}" class="btn btn-default"><i class="fa fa-circle-o"></i></a>
                                <a href="{{ url('/moneybook?y=' . $range['next_year'] . '&m=' . $range['next_month']) }}" class="btn btn-default"><i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
					<table id="records" class="row-border" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>날짜</th>
								<th>구분</th>
								<th>분류</th>
								<th>사용내역</th>
								<th>금액</th>
								<!--<th>Balance</th>-->
							</tr>
						</thead>
					</table>
			        
			        <div class="row mt">
			            <div class="col-sm-3 col-sm-offset-9">
    			            <table id="total" class="" cellspacing="0" width="100%">
    			                <tr>
        		                    <td>카드 지출</td>
        		                    <td class="value"><span id="card_sum">0</span></td>
                                </tr>
                                <tr>
        		                    <td>현금 수입</td>
        		                    <td class="value"><span id="inc_sum">0</span></td>
                                </tr>
                                <tr>
        		                    <td>현금 지출</td>
        		                    <td class="value"><span id="out_sum">0</span></td>
                                </tr>
                                <tr>
        		                    <td>현금 잔액</td>
        		                    <td class="value"><span id="balance">0</span></td>
        		                </tr>
        		            </table>    
			            </div>
    			        
			        </div>
			        
			        
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
					{{ Form::open(array('id' => 'recordForm', 'url' => 'record', 'class' => 'form-horizontal style-form', 'data-async', 'autocomplete' => 'off')) }}

                        <div class="form-group">
                            {{ Form::label('target_at', '날짜', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="target_at" id="target_at">
                            </div>
                        </div>

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
                                                <input type="radio" name="type" id="record_type_out" value="OUT">현금 지출
                                            </label>
                                            <label class="btn btn-default">
                                                <input type="radio" name="type" id="record_type_card" value="CRD">카드 사용
                                            </label>
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
                            {{ Form::label('value', '구분', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-8">
                                <select class="selectpicker" name="category_code" id="category_code">
                                    <?php $grpOpen = 0; ?>
                                    @foreach ($categories as $category)
                                        @if (  $category->code === "99" || (strpos($category->parent_code, "01") === 0) )
                                            @if ( $category->level === "1" )
                                                @if( $grpOpen != 0 )
                                                </optgroup>
                                                @endif
                                                <optgroup label="{{ $category->disp_name }}">
                                                <?php $grpOpen = 1;?>
                                            @elseif  ( $category->level === "2" )
                                                <option value="{{ $category->code }}">{{ $category->disp_name }}</option>
                                            @else
                                                <option value="{{ $category->code }}">{{ $category->disp_name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                    @if( $grpOpen != 0 )
                                        </optgroup>
                                    @endif
                                                
                                </select>
                            </div>
                        </div>
                        
                        
                        <button type="submit" class="btn btn-primary btn-lg btn-block">확인</button>
                    {{ Form::close() }}				
				
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">삭제 확인</h4>
			</div>
			<div class="modal-body">
				<b>'<span id="confirmDeleteModalRecordName"></span>'</b>을(를) 지우시겠습니까?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="btnDelete">Delete</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="startValueSettingModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">시작 금액 설정</h4>
			</div>
			<div class="modal-body">

	                    {{ Form::open(array('id' => 'startValueForm', 'url' => 'record/startValue', 'class' => 'form-horizontal style-form', 'data-async', 'autocomplete' => 'off')) }}
                        <input type="hidden" name="target_at" id="start_value_target_at"/>
                        <div class="form-group">
                            {{ Form::label('value', '시작 금액', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-8">
                                {{ Form::text('value', '', array('class' => 'form-control number', 'min' => '1', 'placeholder' => '금액을 입력하세요', 'id'=>'startValue', 'onkeypress'=>'validate(event)' , 'style'=>'text-align:right;')); }}
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg btn-block">확인</button>
                    {{ Form::close() }}	
				
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
{{ HTML::script('js/bootstrap-js/button.js'); }}
{{ HTML::script('js/bootstrap-select/bootstrap-select.js'); }}

<script>

var table;

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

function today() {
    return new Date();
}

// Get formatted date YYYY-MM-DD
function getFormattedDate(date) {
    return date.getFullYear()
        + "-"
        + ("0" + (date.getMonth() + 1)).slice(-2)
        + "-"
        + ("0" + date.getDate()).slice(-2);
}

function showStartValueSettingModel(target_at){
    
    $("#start_value_target_at").val(target_at);
    
    $.ajax("{{ url('/record/startValue') }}?target_at=" + target_at)
	.done(function(data){
	    $('#startValue').val(data.value_disp);
	    $('#startValueSettingModel').modal('show');    
	});
	
    
    
}

function writeRecordModel(){
    
    $('#recordForm').attr('method', 'POST');
    $('#recordForm').attr('action', '{{ url("record"); }}');
    
    $('#recordForm')[0].reset();

    $("#record_type_inc").parent().removeClass("active");
    $("#record_type_out").parent().removeClass("active");
    $("#record_type_card").parent().removeClass("active");
    
    $("#category_code").val("99");
    $("#category_code").selectpicker('render');
    
    //$("input:radio[name='type']").val("INC");
    //$("#record_type_inc").parent().addClass("active");
    
    $("#target_at").val(getFormattedDate(today()));
    
    $('#writeModal').modal('show');
    
}


function editRecordModal(id){
	
	$('#recordForm').attr('method', 'PUT');
    $('#recordForm').attr('action', '{{ url("record"); }}' + "/" + id);
    
	
	$.ajax("{{ url('/record') }}/" + id)
	.done(function(data){
	    console.log(data);
	    $('#target_at').val(data.target_at);
	    
	    if(data.type === 'OUT'){
	        //$("input:radio[name='type']").val("OUT");
	        $("#record_type_out").parent().addClass("active");
	        $("#record_type_inc").parent().removeClass("active");
	        $("#record_type_card").parent().removeClass("active");
	    } else if(data.type === 'INC'){
	        //$("input:radio[name='type']").val("INC");
	        $("#record_type_inc").parent().addClass("active");
	        $("#record_type_out").parent().removeClass("active");
	        $("#record_type_card").parent().removeClass("active");
	    } else if(data.type === 'CRD'){
	        //$("input:radio[name='type']").val("INC");
	        $("#record_type_card").parent().addClass("active");
	        $("#record_type_inc").parent().removeClass("active");
	        $("#record_type_out").parent().removeClass("active");
	    }
	    
	    console.log($("input:radio[name='type']").val());
	        
	    $('#context').val(data.context);
	    $('#value').val(data.value_disp);
	    
	    $("#category_code").val(data.category_code);
        $("#category_code").selectpicker('render');
    
	    
	    // $('#btnDelete').one('click', function(){
	    //     deleteRecord(id);
	    // });
	    //$('#confirmDeleteModal').modal('show');
	    $('#writeModal').modal('show');
	});

}


function deleteRecordModal(id){
	
	$.ajax("{{ url('/record') }}/" + id)
	.done(function(data){
	    $('#confirmDeleteModalRecordName').html(data.type_name + " - " + data.context + "(" + data.value_disp + ")");
	    $('#btnDelete').one('click', function(){
	        deleteRecord(id);
	    });
	    $('#confirmDeleteModal').modal('show');
	});
	
}

function deleteRecord(id){
	
	$.ajax("{{ url('/record') }}/" + id, {'type' : 'DELETE'})
	.done(function(data){
	   table.ajax.reload();
	   $('#confirmDeleteModal').modal('hide');
	});
}

function format ( d ) {
    // `d` is the original data object for the row
    
    var html = '';
    
    if(d.type == 'STV'){
        
        html = '<table width="100%" cellspacing="0" style="padding:0;">'+
        		'<tr>'+
        			'<td style="padding:0; margin:0;">'+
        				'<div class="btn-group">'+
      						'<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">'+
        						'Action <span class="caret"></span>'+
      						'</button>'+
      						'<ul class="dropdown-menu" role="menu">'+
        						'<li><a href="javascript:startValueModal(\''+ d.id +'\')">수정</a></li>'+
        					'</ul>'+
    					'</div>'+
        			'</td>'+
        			'<td style="padding:0; margin:0;">'+
        			'</td>'+
        		'</tr>'+'</table>';
        
    }else if(d.type == 'OUT' || d.type == 'INC'){
    
        html = '<table width="100%" cellspacing="0" style="padding:0;">'+
        		'<tr>'+
        			'<td style="padding:0; margin:0;">'+
        				'<div class="btn-group">'+
      						'<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">'+
        						'Action <span class="caret"></span>'+
      						'</button>'+
      						'<ul class="dropdown-menu" role="menu">'+
        						'<li><a href="javascript:editRecordModal('+ d.id +')">수정</a></li>'+
        						'<li><a href="javascript:deleteRecordModal('+ d.id +')">삭제</a></li>'+
        					'</ul>'+
    					'</div>'+
        			'</td>'+
        			'<td style="padding:0; margin:0;">'+
        				'<p class="text-right"><small>현금 잔액 : '+d.balance_disp+'</small></p>'+
        			'</td>'+
        		'</tr>'+'</table>';
    }else if(d.type == 'CRD'){
    
        html = '<table width="100%" cellspacing="0" style="padding:0;">'+
        		'<tr>'+
        			'<td style="padding:0; margin:0;">'+
        				'<div class="btn-group">'+
      						'<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">'+
        						'Action <span class="caret"></span>'+
      						'</button>'+
      						'<ul class="dropdown-menu" role="menu">'+
        						'<li><a href="javascript:editRecordModal('+ d.id +')">수정</a></li>'+
        						'<li><a href="javascript:deleteRecordModal('+ d.id +')">삭제</a></li>'+
        					'</ul>'+
    					'</div>'+
        			'</td>'+
        			'<td style="padding:0; margin:0;">'+
        				'<p class="text-right"><small>카드 지출 합 : '+d.card_sum_disp+'</small></p>'+
        			'</td>'+
        		'</tr>'+'</table>';
    }
    		
    return html;
}

$(function(){

    table = $('#records').DataTable( {
        "ajax": '{{ url("/record?start=" . $range["start"] . "&end=" . $range["end"]); }}',
        "ordering": false,
        "paging": false,
        "info": false,
        "searching": false,
        "columnDefs": [
    		{ "targets": 0, "width": "12%"},
    		{ "targets": 1, "width": "8%"},
    		{ "targets": 2, "width": "12%"},
    		{ "targets": 3, "width": "auto"},
    		{ "targets": 4, "width": "20%"}
  		],
  		"columns": [
            { "data": "date_disp"		, "className": "dt-head-center dt-body-center details-control record small" },
            { "data": "type_name"		, "className": "dt-center record small" },
            { "data": "category_name"	, "className": "dt-center record small" },
            { "data": "context"			, "className": "dt-head-center dt-body-left record pd context" },
            { "data": "value_disp"		, "className": "dt-head-center dt-body-right record small" }
        ],
  		"fnCreatedRow": function( nRow, aData, iDataIndex ) {
  			//console.log(nRow);
  			if( aData['type'] == "STV" ){
  			    $('td.context', nRow).html($('td.context', nRow).html() + " <button id='btnStartValueSetting' onClick='showStartValueSettingModel(\"" + aData['id'] + "\");' class='btn btn-warning btn-xs'>시작 금액 설정</button>");    
  			} else if ( aData['type'] == "INC" ){
				$('td', nRow).css('color', '#428bca');
			} else if ( aData['type'] == "OUT" ){
			    $('td', nRow).css('color', '#aa0000');
			} else if ( aData['type'] == "CRD" ){
			    $('td', nRow).css('color', '#FF8600');
			}
			
			$("#card_sum").html(aData['card_sum_disp']);
			$("#inc_sum").html(aData['inc_sum_disp']);
			$("#out_sum").html(aData['out_sum_disp']);
			$("#balance").html(aData['balance_disp']);
			
	    }
    });
    
    
    // Add event listener for opening and closing details
    $('#records tbody').on('click', 'td.record', function () {
        var tr = $(this).closest('tr');
        //console.log(tr);
        // console.log(table);
        
        var row = table.row( tr );
        
        if( row.data().type != "STV" ){
        
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        }
        
    });
    
    $('form[data-async]').on('submit', function(event) {
        var $form = $(this);
        var $target = $($form.attr('data-target'));
 
         if($("#record_type_inc").parent().hasClass("active")){
             $("#record_type_inc").button('toggle');
         }else {
             $("#record_type_out").button('toggle');
         }
 
         console.log($form.serialize());
 
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize()
        }).done(function(data, textStatus, jqXHR){
            //console.log(textStatus);
            //location.reload();
            table.ajax.reload();
            $('.modal').modal('hide');
            
        }).fail(function(jqXHR, textStatus, errorThrown){
            //console.log(textStatus);
        });
 
        event.preventDefault();
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

});


</script>
@stop