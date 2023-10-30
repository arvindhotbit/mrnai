<body>
	<div class="wrapper">
		<div class="card card-bottom _setLocation h-100vh rounded-0" id="demo">
			<div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-start">
				<a href="<?php echo site_url('signup');?>"><img src="<?php echo site_url();?>assets/front/images/ic_close_light.svg" alt=""></a>
				<h1 class="card-title mb-0 text-center"><?php echo $this->lang->line('lab_security_quest_text');?> <br/><br/>  <small class="themegreen"><?php echo $this->lang->line('lab_ans_security_quest_text');?></small></h1>
				<span></span>
			</div>
			<div class="card-body formlayout">
				<form class="w-100" method="POST" id="b_qustion_frm" action="<?php echo base_url("forgot_secury_verify"); ?>" role="form" data-parsley-validate>
					<?php foreach ($security_question as $key => $value) { ?>
					<div class="mb-4">
						<h6><?php echo $this->lang->line('lab_question_text');?> <?php echo ($key+1);?></h6>
						<label><?php echo $value['question'];?></label>
						<input type="hidden" name="qustion_id[]" value="<?php echo $value['id'];?>">
						<input type="text" name="qustion_ans[]" id="" placeholder="<?php echo $this->lang->line('input_write_here');?>" class="form-control">
					</div>
					<?php } ?>
					<a href="javascript:void(0);" onclick="submitBtn()" id="b_qustion_frm_btn" class="btn orangeBtn shadow mb-3">
						<h4 class="mb-0 "><?php echo $this->lang->line('btn_submit_text');?></h4>
					</a>
				</form>
			</div>
		</div>
	</div>

<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script type="text/javascript">
	
function submitBtn() {
	var id="b_qustion_frm";
  var form_action=$("#"+id).attr('action');
  $("#"+id).parsley().validate();
  var form = $('#'+id)[0];
  if($("#"+id).parsley().isValid()){
    var formData = new FormData(form);
    $("#loader").show(); 
    $("#"+id+"_btn").attr('disabled',true);
    $.ajax({
      url: form_action,
      type: 'POST',
      data: formData,
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false,
      success:function(resp){
        $("#loader").hide();  
        $("#"+id+"_btn").attr('disabled',false);
        if(resp.status==1){
            location.href=resp.returnurl;
        }else{
        	swal(resp.msg);
        	if(resp.status==2){
        		setTimeout(function() {
	            location.href="<?php echo site_url('forgot_password');?>";
	          }, 1000);
        	}
        }
      },
      error:function(err){
        $("#"+id+"_btn").attr('disabled',false);
        $("#loader").hide();
        swal("error",`<?php echo $this->lang->line('err_something_wrong');?>`);
      }
    });
  }
  return false;
}
</script>