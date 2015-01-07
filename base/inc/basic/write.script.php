<!-- js placed at the end of the document so the pages load faster -->
<script src="<?=$ctx?>js/jquery.js"></script>
<script src="<?=$ctx?>js/bootstrap.min.js"></script>
<script src="<?=$ctx?>js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?=$ctx?>js/jquery.ui.touch-punch.min.js"></script>
<script class="include" type="text/javascript" src="<?=$ctx?>js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?=$ctx?>js/jquery.scrollTo.min.js"></script>
<script src="<?=$ctx?>js/jquery.nicescroll.js" type="text/javascript"></script>

<!--common script for all pages-->
<script src="<?=$ctx?>js/common-scripts.js"></script>

<!--script for this page-->
<script src="<?=$ctx?>js/moment.js" type="text/javascript"></script>
<script src="<?=$ctx?>js/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?=$ctx?>js/jquery.serialize-object.min.js"></script>

<script>
  $(function () {
    $('#writeTab a:first').tab('show')
  })
</script>

<script type="text/javascript">
    $(function () {
        // target date picker 
        $('#targetDatePicker').datetimepicker({
            pickTime: false,
            defaultDate: new Date()
        });
        
    });
    
    
</script>

<script>

$(function(){
    // save button
    $("#btn-save").click(function(){
        save();
    });
    
});

function save(){
    var record = $('form#record').serializeObject();
    console.log (record);
    
}
    

</script>

<script>
</script>
