@section('style')

{{ HTML::style('js/fullcalendar/fullcalendar.css'); }}

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
	            <div class="panel">
	            	<div class="panel-body">
						<div id="calendar" class="has-toolbar"></div>
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

{{ HTML::script('js/moment.js'); }}
{{ HTML::script('js/fullcalendar/fullcalendar.js'); }}

<!--common script for all pages-->
{{ HTML::script('js/common-scripts.js'); }}

<!--script for this page-->

<script>

$(function(){

	//events:'{{ url("stamp/" . $stampCard->id . "/calender/2014/12.json") }}'
	
	$('#calendar').fullCalendar({
	
		header: {
			//left: 'prev,next today',
			//center: 'title'
			//right: 'month,agendaWeek,agendaDay'
		},
		
		editable: false,
		//eventLimit: true, // allow "more" link when too many events
		events: {
			url: '{{ url("stamp/" . $stampCard->id . "/calender.json") }}'
		},
		eventRender: function(event, element) {
			//console.log(event);
		 	// get your new title somehow
		 	var title = '<i class="fa fa-paw fa-4x stamp-it red"></i><br>x' + event.title;
		 	// replace the event title
		 	element.find('.fc-title').html( title );
		}
	
	});


});


</script>
@stop