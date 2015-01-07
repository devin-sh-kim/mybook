@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-right"></i> Memo</h3>
        
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4><i class="fa fa-angle-right"></i> Write</h4>
                    {{ Form::open(array('url' => 'memo', 'class' => 'form-horizontal style-form', 'files' => true)) }}
                        
                        <div class="form-group">
                            {{ Form::label('title', 'Title', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-10">
                                {{ Form::text('title', '', array('class' => 'form-control', 'placeholder' => '제목을 입력하지 않으면 현재 시간으로 저장됩니다')); }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label('attach', 'Attach File', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-10">
                                {{ Form::file('attach', '', array('class' => 'form-control')); }}
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label('context', 'Context', array('class' => 'col-sm-2 control-label')); }}
                            <div class="col-sm-10">
                                {{ Form::textarea('context', '', array('class' => 'form-control')); }}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->
<!--main content end-->

@stop