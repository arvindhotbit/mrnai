<body >
	<div class="wrapper ">
		<div class="card card-bottom _setLocation h-100vh rounded-0" >
			<div class="card-header px-2 bg-transparent border-0 d-flex justify-content-between align-items-center">
				<a href="<?php echo site_url();?>"><img src="<?php echo site_url();?>assets/front/images/ic_close_light.svg" alt=""></a>
				<h1 class="card-title mb-0"><?php echo $this->lang->line('lab_reset_password_text');?></h1>
				<span></span>
			</div>
			<div class="card-body px-4 py-1">
				<form method="POST" id="b_frm" action="<?php echo base_url("reset_password"); ?>" role="form" data-parsley-validate>
					<div class="my-5">
						<h2><?php echo $this->lang->line('lab_new_password_text');?></h2>
					</div>
					
					<div class="mb-3 input-group">
						<input type="password" name="password" id="password" placeholder="<?php echo $this->lang->line('input_business_password_text');?>" class="border-end-0 form-control" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('input_business_password_req');?>" data-parsley-errors-container="#err_password">
						<span class="input-group-text bg-white border-start-0">
							<img src="<?php echo site_url();?>assets/front/images/ic_password.svg" alt="">
						</span>
					</div>
					<span id="err_password"></span>
					<div class="mb-3 input-group">
						<input type="password" name="confrim_password" id="" placeholder="<?php echo $this->lang->line('input_business_c_password_text');?>" class="border-end-0 form-control" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('input_business_c_password_req');?>" data-parsley-equalto="#password" data-parsley-equalto-message="<?php echo $this->lang->line('input_password_match_err');?>" data-parsley-errors-container="#err_confpassword">
						<span class="input-group-text bg-white border-start-0">
							<img src="<?php echo site_url();?>assets/front/images/ic_password.svg" alt="">
						</span>
					</div>
					<span id="err_confpassword"></span>
					<a href="javascript:void(0);" onclick="submitBtn()" class="btn orangeBtn shadow mb-3" id="b_frm_btn">
						<h4 class="mb-0 "><?php echo $this->lang->line('btn_update_text');?></h4>
						<img class="position-absolute right-8" src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt="">
					</a>
				</form>
			</div>
			<div class="card-footer p-4 border-0 bg-transparent text-center">
				<a href="<?php echo site_url('forgot_password');?>" class="text-center linkClrforgot"><?php echo $this->lang->line('lab_sign_forgot_password_text');?></a>
			</div>
		</div>

	</div>



<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script type="text/javascript">
	
function submitBtn() {
	var id="b_frm";
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
		          	setTimeout(function() {
		            	location.href=resp.returnurl;
		          	}, 1000);
		        }else{
        			if(resp.status==2){
        				swal(resp.msg);
    					setTimeout(function() {
        					location.href=resp.returnurl;
      					}, 2000);
        			}else{
        				swal(resp.msg);
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