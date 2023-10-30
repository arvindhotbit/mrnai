<body >
	<div class="wrapper ">
		<div class="card card-bottom _setLocation h-100vh rounded-0" >
			<div class="card-header px-2 bg-transparent border-0 d-flex justify-content-between align-items-center">
				<a href="<?php echo site_url();?>"><img src="<?php echo site_url();?>assets/front/images/ic_close_light.svg" alt=""></a>
				<h1 class="card-title mb-0"><?php echo $this->lang->line('lab_forgot_password_text');?></h1>
				<span></span>
			</div>
			<div class="card-body px-4 py-1">
				<form method="POST" id="b_frm" action="<?php echo base_url("check_business_number"); ?>" role="form" data-parsley-validate>
					<div class="my-5">
						<img class="img-fluid logoF" src="<?php echo site_url();?>assets/front/images/img_hello@2x.png" alt="">
					</div>
					<div class="mb-3  input-group">
						<input type="text" name="mobile_no" placeholder="<?php echo $this->lang->line('input_business_mobile_text');?>" class="border-end-0 form-control" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="10" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('input_business_mobile_req');?>" data-parsley-errors-container="#err_mobile_no">
						<span class="input-group-text bg-white border-start-0">
							<img src="<?php echo site_url();?>assets/front/images/ic_email.svg" alt="">
						</span>
					</div>
					<span id="err_mobile_no"></span>
					<a href="javascript:void(0);" onclick="submitBtn()" class="btn orangeBtn shadow mb-3" id="b_frm_btn">
						<h4 class="mb-0 "><?php echo $this->lang->line('btn_check_text');?></h4>
						<img class="position-absolute right-8" src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt="">
					</a>
					<p class="text-white text-center"><?php echo $this->lang->line('lab_already_business_text');?> <a href="<?php echo site_url('login');?>" class="linkClr"><?php echo $this->lang->line('lab_signin_now_text');?></a>

					</p>
				</form>
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
		            location.href=resp.returnurl;
        		}else{
        			swal(resp.msg);
        		}
      		},
      		error:function(err){
		        $("#"+id+"_btn").attr('disabled',false);
		        $("#loader").hide();
		        swal(`<?php echo $this->lang->line('err_something_wrong');?>`);
      		}
    	});
  	}
  	return false;
}
</script>