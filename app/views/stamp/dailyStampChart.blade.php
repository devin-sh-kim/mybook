@section('style')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<style>
i.red {
    color: #bd0a0a;
}

.fc-content {
	
	text-align : center;
	color: #000;
}

.fc-event {
	background-color: inherit;
	border: 0;
}

</style>
@stop

@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-paw"></i> 도장 쾅!!</h3>
        
        <div class="row mt">
            <div class="col-lg-12">
                
                <div class="row mb">
            		<div class="col-lg-12">
	            		<div class="pull-left">
	                        <button type="button" class="btn btn-link" id="btnBack">돌아가기</button>
                        
	            		</div>
	            		@if( $stampCard->input_value == 'Y' )
	                	<div class="pull-right">
							<a id="tab-chart" href="{{ url('/stamp/' . $stampCard->id . '/chart?type=user-value'); }}">사용자 입력 챠트 보기</a>
						</div>
						@endif
					</div>
                </div>
                
                
				<div class="content-panel">
					<div class="panel-body">
						<div id="chart" style="height: 250px;"></div>
					</div>
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

<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


<!--common script for all pages-->
{{ HTML::script('js/common-scripts.js'); }}

<!--script for this page-->

<script>

var json_data = [
    {stamp:0, value:0}
  ];

$(function(){

    $('#btnBack').on('click', function(){
       window.location = "{{ url('/stamp/' . $stampCard->id); }}"; 
    });

    line = new Morris.Bar({
		// ID of the element in which to draw the chart.
		element: 'chart',
		// Chart data records -- each entry in this array corresponds to a point on
		// the chart.
		data: json_data,
		// The name of the data record attribute that contains x-values.
		xkey: 'stamp',
		// A list of names of data record attributes that contain y-values.
		ykeys: ['value'],
		// Labels for the ykeys -- will be displayed when you hover over the
		// chart.
		labels: ['스템프'],
		
		resize: true,
		
	});

    $.ajax({
        type: "GET",
        dataType: 'json',
        url: "{{ url('stamp/' . $stampCard->id . '/dailyStampChart.json') }}", // This is the URL to the API
        data: {  } // Passing a parameter to the API to specify number of days
    })
    .done(function( data ) {
        // When the response to the AJAX request comes back render the chart with new data
        line.setData(data);
    })
    .fail(function() {
        // If there is no communication between the server, show an error
        alert( "error occured" );
    });
    
    
    line.redraw();

});


</script>
@stop