@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-angle-paw"></i> 쓰기</h3>
        
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel">
                    <h4><i class="fa fa-angle-right"></i> 쓰기</h4>
                    {{ Form::open(array('url' => 'record', 'class' => 'form-horizontal style-form')) }}

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
                        
                    </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block">확인</button>
                    {{ Form::close() }}
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
{{ HTML::script('js/bootstrap-js/button.js'); }}


<script>

$(function(){
    $("#target_at").val(getFormattedDate(today()));

    
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

});

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


</script>
@stop