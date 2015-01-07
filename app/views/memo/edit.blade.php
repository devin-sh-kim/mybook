@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Memo</h3>
        
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4><i class="fa fa-angle-right"></i> Write</h4>
                    
                    {{ Form::model($memo, array('method' => 'put', 'route' => array('memo.update', $memo->id), 'class' => 'form-horizontal style-form', 'files' => true)) }}
                    
                        <div class="form-group">
                            {{ Form::label('title', 'Title', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-10">
                                {{ Form::text('title', null, array('class' => 'form-control')); }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('attach', 'Attach File', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-10">
                                {{ Form::file('attach', null, array('class' => 'form-control')); }}
                            </div>
                        </div>

						    @if ( $memo->attach != '' )
                        	<div class="form-group">
                        
                            	
                                @if ( starts_with( $memo->attach_type, 'image' ) )
								<div class="col-sm-4 col-sm-offset-2">
									<img class="thumbnail img-responsive" src="{{ asset('memo/attach/' . $memo->id) }}" alt="{{ $memo->filename }}">
								</div>
								<div class="col-sm-6">
                                	<span class="glyphicon glyphicon-picture"></span> {{ link_to(asset('memo/attach/' . $memo->id), $memo->filename) }}
                            	@else
                                <div class="col-sm-6">
                                	<span class="glyphicon glyphicon-paperclip"></span> {{ link_to(asset('memo/attach/' . $memo->id), $memo->filename) }}
                            	@endif
                                	<br/>
                                	{{ Form::checkbox('removeAttach', 'removeAttach'); }}
                                	{{ Form::label('removeAttach', 'Delete'); }}
                                </div>
	                        </div>
                    		@endif
						
                        <div class="form-group">
                            {{ Form::label('context', 'Context', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-10">
                                {{ Form::textarea('context', null, array('class' => 'form-control')); }}
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Update</button>
                    
                    {{ Form::close() }}
                
                </div>
            </div>
        </div>

    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->
<!--main content end-->

@stop