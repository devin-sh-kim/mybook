@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-file-text"></i> Memo</h3>
        
        {{ link_to('memo/create', 'New', $attributes = array('class'  => 'btn btn-theme')); }}
        
        <div class="row mt">
            <div class="col-lg-12">
                
                <! -- ROW OF PANELS -->
				<!-- Product Panel -->
				<div class="row">

                    @foreach ($memos as $memo)
                    <! -- Memo Panel -->
					<div class="col-lg-4 col-md-4 col-sm-4 mb">
						<div class="content-panel memo">
							@if ( starts_with( $memo->attach_type, 'image' ) )
							<div id="memo-img" style="background-image: url({{ asset('memo/attach/' . $memo->id) }});">
							@else
							<div id="memo-bg">
							@endif
								<div class="memo-title">
								    <a href="{{ url('memo/' . $memo->id); }}">{{ $memo->title }}</a>
								    <?php $wordWrap = 120; ?>
								    @if ( $memo->attach_type != '' )
								        @if ( starts_with( $memo->attach_type, 'image' ) )
								        <?php $wordWrap = 60; ?>
								        <span class="glyphicon glyphicon-picture"></span>
								        @else
								        <span class="glyphicon glyphicon-paperclip"></span>
								        @endif
								    @endif
								    
								</div>
							</div>
                            <!--
                            <div class="badge badge-popular">POPULAR</div>
                            -->
						    
							
							<div class="memo-text">
							    <p style="word-wrap: break-word;">{{ Str::limit($memo->context, $wordWrap) }} </p>
							    <div style="position: absolute; bottom: 10px; right: 25px;">
							        <a href="{{ url('memo/' . $memo->id); }}">Read More</a>
							    </div>
							</div>
						</div>
					</div><!-- /col-md-4-->

                    @endforeach

				</div><! -- ROW OF PANELS -->

				{{ $memos->links(); }}

            </div>
        </div>

    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->
<!--main content end-->

@stop