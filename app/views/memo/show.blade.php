@section('content')

<style>
.center-cropped {
  width: 100%;
  height: 200px;
  background-position: top center;
  background-repeat: no-repeat;
}

pre {
    white-space: pre-wrap;       /* CSS 3 */
    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    word-wrap: break-word;       /* Internet Explorer 5.5+ */
}

</style>

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Memo</h3>
        
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4><i class="fa fa-angle-right"></i> <b>{{ $memo->title }}</b></h4>
                    <hr/>
                    {{ Form::open(array('url' => 'memo', 'class' => 'form-horizontal style-form')) }}
                        
                        @if ( $memo->attach != '' )
                        <div class="form-group">
                        
                            @if ( starts_with( $memo->attach_type, 'image' ) )
                                <div class="col-sm-4">
                                    <!--                            	
                                	<a class="thumbnail fancybox" href="{{ asset('memo/attach/' . $memo->id) }}">
	                            	    <div class="center-cropped" 
                                         style="background-image: url('{{ asset('memo/attach/' . $memo->id) }}');">
                                        </div>
                                	</a>
	                            	-->
                                	<a class="thumbnail fancybox" href="{{ asset('memo/attach/' . $memo->id) }}">
	                            	    <img class="img-responsive" src="{{ asset('memo/attach/' . $memo->id) }}" alt="{{ $memo->filename }}">
	                            	</a>
	                            </div>
	                            <div class="col-sm-8">
                                    <span class="glyphicon glyphicon-picture"></span> {{ link_to(asset('memo/attach/' . $memo->id), $memo->filename, array('target' => '_blank')); }}
                                </div>
                            @else
                                <div class="col-sm-12">
                                    <span class="glyphicon glyphicon-paperclip"></span> {{ link_to(asset('memo/attach/' . $memo->id), $memo->filename, array('target' => '_blank')); }}
                                </div>
                            @endif
                        </div>

                        @endif

                            
                        
                        <div class="form-group">
                            <!--
                            <label class="col-sm-2 col-sm-2 control-label">Context</label>
                            -->
                            <div class="col-sm-12">
                                <p class="form-control-static">
                                    <pre>{{ $memo->context }}</pre>
                                </p>
                            </div>
                        </div>
                        <a href="{{ url('memo/' . $memo->id . '/edit') }}" class="btn btn-primary btn-lg btn-block">Edit</a>
                        <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#confirmDeleteModal">Delete</button>
                        <a href="{{ route('memo.index', array('page' => Session::get('LAST_PAGE', function() { return '1'; }))); }}" class="btn btn-primary btn-lg btn-block">Return To List</a>
                        
                    {{ Form::close() }}
                </div>
            </div>
        </div>

    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->
<!--main content end-->

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">삭제 확인</h4>
			</div>
			<div class="modal-body">
				<b>'{{ $memo->title }}'</b>을(를) 지우시겠습니까?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onClick="deleteMemo('{{ $memo->id }}')">Delete</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop