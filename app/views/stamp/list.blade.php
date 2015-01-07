@section('content')

<style>
.huge {
    font-size: 40px;
}

.pn {
    height: auto;
}
</style>

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-paw"></i> 도장 쾅!!</h3>
        
        {{ link_to('stamp/create', 'New', $attributes = array('class'  => 'btn btn-theme')); }}
        
        <div class="row mt">
            <div class="col-lg-12">
                
                <! -- ROW OF PANELS -->
                <!-- Product Panel -->
				<div class="row">
				
                    @foreach ($stampCards as $stampCard)
                    <! -- Stamp Card Panel -->
                    
					<div class="col-lg-4 col-md-6 mb">
						<div class="content-panel pn stamp-card" data-id="{{ $stampCard->id }}">
						    <div class="panel-heading">
						        <div class="row">
                                    <div class="col-xs-3">
                                        <div style="padding-left:20px;padding-bottom:15px;">
                                            <i class="fa fa-paw fa-5x"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div>{{ $stampCard->goal }}</div>
                                        <div class="huge">{{ $stampCard->stamp_count }}/{{ $stampCard->max_stamp_num }}</div>
                                    </div>
                                </div>
						    </div>
						    <div class="panel-footer">
                                <span class="pull-left">
                                @if( $stampCard->end_date != '0000-00-00' )
                                    {{ $stampCard->end_date }}까지
                                @endif
                                
                                @if( $stampCard->reset_type == '0' )
                                    반복 없음
                                @elseif( $stampCard->reset_type == '1' )
                                    매일
                                @elseif(  $stampCard->reset_type == '2'  )
                                    매주
                                    @if( $stampCard->reset_day == '7' )
                                        일요일
                                    @elseif( $stampCard->reset_day == '1' )
                                        월요일
                                    @elseif( $stampCard->reset_day == '2' )
                                        화요일
                                    @elseif( $stampCard->reset_day == '3' )
                                        수요일
                                    @elseif( $stampCard->reset_day == '4' )
                                        목요일
                                    @elseif( $stampCard->reset_day == '5' )
                                        금요일
                                    @elseif( $stampCard->reset_day == '6' )
                                        토요일
                                    @endif
                                    시작
                                @elseif(  $stampCard->reset_type == '3'  )
                     				매월 시작
                                @endif
                                
                                {{ $stampCard->prev_stamp_count }}
                                
                                </span>
                                <!--
                                <a href="{{ url('stamp/' . $stampCard->id ) }}">
                                	<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                </a>
                                -->
                                <div class="clearfix"></div>
                            </div>
						</div>
					</div><!-- /col-md-4-->
                    
                    @endforeach
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

<script>

$(function(){
    $('.stamp-card').click(function(){
        
        //alert($(this).attr("data-id"));
        window.location = '{{ url("stamp"); }}/' + $(this).data("id");
    });
});


</script>
@stop