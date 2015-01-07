@section('script')
<!-- js placed at the end of the document so the pages load faster -->
{{ HTML::script('js/jquery.js'); }}
<!-- FancyBox -->
{{ HTML::script('js/fancybox/jquery.fancybox.js'); }}

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

$(function() {
    // fancybox
    $(".fancybox").fancybox({
        "type": "image"
    });
    
    $.fancybox.update();
    
});

function deleteMemo(id){

    $.ajax({
        type: "DELETE",
        url: "{{ url('memo'); }}/" + id
    })
    .done(function( data ) {
        if( data.result == true ){
            location.href = "{{ url('memo'); }}";
        } else {
            alert("Delete Fail");
            location.href = "{{ url('memo'); }}";
        }
    });
}

</script>
@stop