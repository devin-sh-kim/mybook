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

<div class="modal fade" id="confirmTerminateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">종료 확인</h4>
			</div>
			<div class="modal-body">
				<h5><b>'<span id="confirmTerminateModalRecordName"></span>'</b>을(를) 종료하겠습니까?</h5>
				<div class="alert alert-danger mt">
    				해당 내역에 대해 자동으로 입력된 기존 내역은 <strong>남아있게 되며</strong>,<br>종료일 이후로는 해당 고정 비용이 발생하지 않습니다.    
				</div>
				
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
				<button type="button" class="btn btn-danger" id="btnTerminate">종료</button>
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
				<h5><b>'<span id="confirmDeleteModalRecordName"></span>'</b>을(를) 지우시겠습니까?<br></h5>
				<div class="alert alert-danger mt">
				    해당 내역에 대해 자동으로 입력된 기존 내역은 <strong>모두 지워지며</strong>,<br>삭제일 이후로는 해당 고정 비용이 발생하지 않습니다.
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
				<button type="button" class="btn btn-danger" id="btnDelete">삭제</button>
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

function writeRecord(){
	
	location.href='{{ url("fixExpRecord/create") }}';
    
}

function terminateRecordModal(id){
    $.ajax("{{ url('fixExpRecord') }}/" + id)
	.done(function(data){
	    $('#confirmTerminateModalRecordName').html(data.cycle_disp + " " + data.type_name + " - " + data.context + "(" + data.value_disp + ")" + " " + data.start_to_end );
	    $('#btnTerminate').one('click', function(){
	        terminateRecord(id);
	    });
	    $('#confirmTerminateModal').modal('show');
	});
}

function terminateRecord(id){
    $.ajax("{{ url('/fixExpRecord') }}/" + id, {'type' : 'PUT', 'data':{'terminate':true}})
	.done(function(data){
	   table.ajax.reload();
	   $('#confirmTerminateModal').modal('hide');
	});
}

function deleteRecordModal(id){
    $.ajax("{{ url('fixExpRecord') }}/" + id)
	.done(function(data){
	    $('#confirmDeleteModalRecordName').html(data.cycle_disp + " " + data.type_name + " - " + data.context + "(" + data.value_disp + ")" + " " + data.start_to_end);
	    $('#btnDelete').one('click', function(){
	        deleteRecord(id);
	    });
	    $('#confirmDeleteModal').modal('show');
	});
}

function deleteRecord(id){
	
	$.ajax("{{ url('/fixExpRecord') }}/" + id, {'type' : 'DELETE'})
	.done(function(data){
	   table.ajax.reload();
	   $('#confirmDeleteModal').modal('hide');
	});
	
}

function format ( d ) {
	console.log(d);
    // `d` is the original data object for the row
    var html = '<table width="100%" cellspacing="0" style="padding:0;">'+
    		'<tr>'+
    			'<td style="padding:0; margin:0;">'+
    				'<div class="btn-group">'+
  						'<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">'+
    						'Action <span class="caret"></span>'+
  						'</button>'+
  						'<ul class="dropdown-menu" role="menu">'+
    						'<li><a href="javascript:terminateRecordModal('+ d.id +')">종료</a></li>'+
    						'<li><a href="javascript:deleteRecordModal('+ d.id +')">삭제</a></li>'+
    					'</ul>'+
					'</div>'+
    			'</td>'+
    			'<td style="padding:0; margin:0;">'+
    				'<p class="text-right"><small>기간 : ' + d.start_to_end + '</small></p>'+
    			'</td>'+
    		'</tr>';
    		
    return html;
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
            { "data": "type_name"		, "className": "dt-center record" },
            { "data": "cycle_disp"		, "className": "dt-head-center dt-body-center details-control record" },
            { "data": "context"			, "className": "dt-head-center dt-body-left record" },
            { "data": "value_disp"		, "className": "dt-head-center dt-body-right record" }
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
    $('#records tbody').on('click', 'td.record', function () {
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

	$('#btnWriteRecord').on('click', function(){
        writeRecord();
    });
    
});


</script>
@stop