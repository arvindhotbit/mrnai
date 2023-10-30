<footer class="main-footer print">
  <strong>Copyright &copy; <?php echo date('Y');?> All rights reserved - <?php echo SITE_TITLE;?>.</strong>
</footer>
   
   <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap-datepicker.css" rel="stylesheet" />
 </div><!-- ./wrapper -->
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/admin/dist/js/app.min.js"></script>

    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>

    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>assets/admin/dist/js/demo.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/datepicker/bootstrap-datepicker.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/js/bootstrap-fileupload.js"></script>

	 <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/admin/plugins/datatables/dataTables.bootstrap.min.js"></script> 

<script>
  $('.datepicker').datepicker({
    format: 'yyyy/mm/dd',
    todayHighlight: true,
    endDate: '+0d',
  });
  function submitDetailsForm(id,seturl='') {
    if(seturl)
    {
        var form_action=seturl;
    }else
    {
        var form_action= "<?php if(!empty($form_action))echo $form_action;?>";
    }
   // var last_element = form_action.split("/").pop(-1);
    //alert();
    $("#"+id).parsley().validate();
    var form = $('#'+id)[0];
    if($("#"+id).parsley().isValid()){
      var formData = new FormData(form);
      $("#loader").show(); 
      $("#submit_form").attr('disabled',true);
      $.ajax({
        url: form_action,
        type: 'POST',
        data: formData,
        dataType: 'json',
        // async: false,
        cache: false,
        contentType: false,
        processData: false,
    
        success:function(resp){
          $("#loader").hide();  
          $("html, body").animate({ scrollTop: 0 }, "slow");
          $(".message_box").html(resp.message);
          $(".message_box").show(); 
          $("#submit_form").attr('disabled',false);
          if(resp.status==0){
            
            setTimeout(function() {
             $(".message_box").html('');
              $(".message_box").hide();
            }, 5000); 
          }else{

            $("#"+id).parsley().reset();
            $("#"+id)[0].reset();
            setTimeout(function() {
             $(".message_box").html('');
              $(".message_box").hide();
              location.reload();
            }, 2000); 
          }
          
        },
        error:function(err){
          $("#submit_form").attr('disabled',false);
          $("#loader").hide();

        }
      });
    }
}
function complete_form(complete_request_id)
    {
       
         swal({
          title: "Confirmation",
          text: "Are you sure you want complete this request ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
    .then((willDelete) => {
        if (willDelete) {
            $("#loader").show();
            $.ajax({
                type: 'POST',
                url: "<?php if(!empty($form_action1)) echo $form_action1; ?>",
                data: {complete_request_id:complete_request_id},
                dataType: 'json',
                success:function(resp){console.log(resp);
                $("#loader").hide();
                $("html, body").animate({ scrollTop: 0 }, "slow");
              $(".message_box").html(resp.message);
               $(".message_box").show(); 
                if(resp.status==0){
                setTimeout(function() {
                 $(".message_box").html('');
                  $(".message_box").hide();
                }, 5000); 
              }else{
                setTimeout(function() {
                 $(".message_box").html('');
                  $(".message_box").hide();
                  location.reload();
                }, 2000); 
              }

                }
            });
        }
    });
}
function validate_image(input,error_param='') {//alert();
    if(error_param=='')
    {
        var error_container='error1';
    }else{
        var error_container=error_param;
       
    }
    $(input).parent().parent().parent().find('.'+error_container).html('');
    if (!input.files[0].name.toLowerCase().match(/\.(jpg|jpeg|png|JPG|JPEG|PNG|pdf|PDF|DOC|DOCX|doc|docx)$/)) {
        $(input).val("");
        $(input).parent().parent().parent().find('.'+error_container).html("Only JPG|JPEG|PNG|DOC|PDF file types allowed.");
        return false;
    }
    if(input.files[0].size>20000000)
    {
        $(input).parent().parent().parent().find('.'+error_container).html("File size should not be more than 20 MB.");
        return false;
    }  
}


function error_blank_expiry(id) {     
    //alert(id);     
    $("#"+id+" li").text('');
} 


</script>
<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>


</body>

</html> 