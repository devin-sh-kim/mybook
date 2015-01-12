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
					<h4>{{ $start . " ~ " . $end }}</h4>
                    <div class="btn-group btn-group-sm">
                        <a href="{{ url('/moneybook?y=' . $prev_year . '&m=' . $prev_month) }}" class="btn btn-default"><i class="fa fa-angle-left"></i></a>
                        <a href="{{ url('/moneybook') }}" class="btn btn-default"><i class="fa fa-circle-o"></i></a>
                        <a href="{{ url('/moneybook?y=' . $next_year . '&m=' . $next_month) }}" class="btn btn-default"><i class="fa fa-angle-right"></i></a>
                    </div>
					<table id="records" class="row-border" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Date</th>
								<th>Type</th>
								<th>Context</th>
								<th>Value</th>
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
					{{ Form::open(array('id' => 'recordForm', 'url' => 'record', 'class' => 'form-horizontal style-form', 'data-async')) }}

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
                                                <input type="radio" name="type" id="record_type_out" value="OUT">지출
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


function writeRecordModel(){
    
    $('#recordForm').attr('method', 'POST');
    $('#recordForm').attr('action', '{{ url("record"); }}');
    
    $('#recordForm')[0].reset();

    $("#record_type_inc").parent().removeClass("active");
    $("#record_type_out").parent().removeClass("active");
    
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
	        $("input:radio[name='type']").val("OUT");
	        $("#record_type_out").parent().addClass("active");
	        $("#record_type_inc").parent().removeClass("active");
	    } else if(data.type === 'INC'){
	        $("input:radio[name='type']").val("INC");
	        $("#record_type_inc").parent().addClass("active");
	        $("#record_type_out").parent().removeClass("active");
	    }
	    
	    console.log($("input:radio[name='type']").val());
	        
	    $('#context').val(data.context);
	    $('#value').val(data.value_disp);
	    
	    
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
    var html = '<table width="100%" cellspacing="0" style="padding:0;">'+
    		'<tr>'+
    			'<td style="padding:0; margin:0;">'+
    				'<div class="btn-group">'+
  						'<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">'+
    						'Action <span class="caret"></span>'+
  						'</button>'+
  						'<ul class="dropdown-menu" role="menu">'+
    						'<li><a href="javascript:editRecordModal('+ d.id +')">Edit</a></li>'+
    						'<li><a href="javascript:deleteRecordModal('+ d.id +')">Delete</a></li>'+
    					'</ul>'+
					'</div>'+
    			'</td>'+
    			'<td style="padding:0; margin:0;">'+
    				'<p class="text-right"><small>Balance : '+d.sum_disp+'</small></p>'+
    			'</td>'+
    		'</tr>';
    		
    return html;
}

$(function(){

    table = $('#records').DataTable( {
        "ajax": '{{ url("/record?start=" . $start . "&end=" . $end); }}',
        "ordering": false,
        "paging": false,
        "info": false,
        "searching": false,
        "columnDefs": [
    		{ "targets": 0, "width": "60"},
    		{ "targets": 1, "width": "40"},
    		{ "targets": 2, "width": "auto"},
    		{ "targets": 3, "width": "100"}
  		],
  		"columns": [
            { "data": "date_disp"			, "className": "dt-head-center dt-body-center details-control" },
            { "data": "type_name"		, "className": "dt-center" },
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
    
    
    // Add event listener for opening and closing details
    $('#records tbody').on('click', 'td.value', function () {
        var tr = $(this).closest('tr');
        // console.log(tr);
        // console.log(table);
        
        var row = table.row( tr );
 
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
            $('#writeModal').modal('hide');
        }).fail(function(jqXHR, textStatus, errorThrown){
            console.log(textStatus);
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