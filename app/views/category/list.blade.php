@section('style')

<style>

.selected {
    font-weight: 900;
}

.btn-circle {
    width: 30px;
    height: 30px;
    padding: 6px 0;
    border-radius: 15px;
    text-align: center;
    font-size: 12px;
    line-height: 1.428571429;
}

.btn-circle.btn-xl {
    width: 70px;
    height: 70px;
    padding: 10px 16px;
    border-radius: 35px;
    font-size: 24px;
    line-height: 1.33;
}

.btn-social{position:relative;padding-left:44px;text-align:left;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.btn-social :first-child{position:absolute;left:0;top:0;bottom:0;width:32px;line-height:34px;font-size:1.6em;text-align:center;border-right:1px solid rgba(0,0,0,0.2)}
.btn-bitbucket{color:#fff;background-color:#205081;border-color:rgba(0,0,0,0.2)}.btn-bitbucket:hover,.btn-bitbucket:focus,.btn-bitbucket:active,.btn-bitbucket.active,.open .dropdown-toggle.btn-bitbucket{color:#fff;background-color:#183c60;border-color:rgba(0,0,0,0.2)}

</style>

@stop

@section('content')

<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <h3><i class="fa fa-paw"></i> 도장 쾅!!</h3>
        <div class="row mt">
            <div class="col-lg-12">
                
                @foreach( $categories as $category )
                    <button class='btn btn-default btn-circle btn-xl' data-code='{{ $category->code }}'>
                        <i class="fa fa-cutlery"></i>
                    </button>
                    {{ $category->disp_name }}    
                    
                @endforeach
                
            </div>
        </div>
    </section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->
<!--main content end-->

<?php
    // <ul class='sub-category-ul' id='sub-{{ $category->code }}'>
    //     @foreach( $sub_categories[$category->code] as $sub )
    //         <li class='sub-category'>{{ $sub->disp_name }}</li>
    //     @endforeach
    // </ul>
?>    

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

    $("ul.sub-category-ul").hide();

    $("li.category").on("click", function(){
        $("ul.sub-category-ul").hide();
        $("#sub-" + $(this).data("code")).show();
    });
    
    $("li.sub-category").on("click", function(){
        $("li.sub-category").removeClass("selected");
        $(this).addClass("selected");
    });
    
});


</script>
@stop