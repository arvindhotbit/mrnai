<body>
    <div class="wrapper h-100vh">
    	<div class="topSection themeClr">
        	<div class="container mini-container">
            	<div class="row ">
                	<div class="col-12 g-0 shadow">
                    	<div class="d-flex bg-white bg-default justify-content-between align-items-center py-2">
                        	<div><a class="cursor-pointer" onclick="history.back()">
                        		<img src="<?php echo site_url();?>assets/front/images/ic_back_dark.svg" alt=""></a>
                        	</div>
                        	<div class="heading">
                            	<h6><?php echo $this->lang->line('lab_add_new_service_text');?></h6>
                        	</div>
                        	<div><a href="#" class="invisible"><img src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt=""></a></div>
                    	</div>
                	</div>
            	</div>
        	</div>
    	</div>
    	<div class="bottomSection mh-auto  mt-3">
        	<div class="container mini-container formSection">
            	<div class="row">
            		<form method="POST" id="b_service_frm" action="<?php echo base_url("add_service"); ?>" role="form" data-parsley-validate>
                	<div class="col-12">
	                    <div class="mb-3">
	                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('lab_service_name_text');?>" name="service_name" maxlength="50" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('err_service_name_text');?>" data-parsley-errors-container="#err_service_name"/>
	                    </div>
	                    <span id="err_service_name"></span>
	                    <div class="mb-3">
	                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('lab_service_person_text');?>" name="service_person" maxlength="50" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('err_service_person_text');?>" data-parsley-errors-container="#err_service_person"/>
	                    </div>
	                    <span id="err_service_person"></span>
	                    <div class="mb-3">
	                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('lab_service_time_text');?>" name="service_time" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="3" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('err_service_time_text');?>" data-parsley-errors-container="#err_service_time"/>
	                    </div>
	                    <span id="err_service_time"></span>
	                    <div class="mb-3">
	                        <select name="gender" id="" class="form-control">
	                            <option value="male" selected>Male</option>
	                            <option value="female">Female</option>
	                        </select>
	                    </div>
	                    <div class="mb-3 d-flex justify-content-between">
	                        <label  for="sameWindow" class="radio-inline">
	                        	<input onchange="windowSet('same')" type="radio" value="same" id="sameWindow" name="window_type" checked>
	                        	<span class="ms-2"><?php echo $this->lang->line('lab_service_same_window_text');?></span> 
	                        </label>
	                        <label for="newwindow" class="radio-inline">
	                        	<input type="radio" id="newwindow" onchange="windowSet('new')" value="new" name="window_type">
	                        	<span class="ms-2"><?php echo $this->lang->line('lab_service_new_window_text');?></span>
	                        </label>
	                    </div>
	                    <div class="mb-3" id="guestwindow">
	                        <select name="window_id" id="window_id" class="form-control" data-parsley-required-message="<?php echo $this->lang->line('err_window_select_text');?>" data-parsley-errors-container="#err_window_id">
	                            <?php foreach ($business_window as $key => $value) { ?>
	                            	<?php $sel="";
	                            	if(!empty($selected)){
	                            		if($selected==$value['id']){
	                            			$sel="selected";
	                            		}
	                            	}else{
	                            		if($key==0){
	                            			$sel="selected";
	                            		}
	                            	}
	                            	?>
	                            	<option value="<?php echo $value['id'];?>" <?php echo $sel;?>><?php echo $value['window_name'];?></option>
	                            <?php }?>
	                        </select>
	                    </div>
	                    <span id="err_window_id"></span>
	                    <div class="mb-3" id="newWindow" >
	                        <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('lab_window_name_text');?>" id="window_name" name="window_name" maxlength="30" data-parsley-required-message="<?php echo $this->lang->line('err_window_name_text');?>" data-parsley-errors-container="#err_window_name"/>
	                    </div>
	                    <span id="err_window_name"></span>
                	</div>
                	</form>
            	</div>
        	</div>
    	</div>
    	<div class="container">
        	<div class="row">
            	<div class="col-12">
                	<button class="btn shadow mb-3 bg-orange w-100 d-flex justify-content-between" onclick="submitBtn()" id="b_service_frm_btn">
                		<span></span><span class="text-white"><?php echo $this->lang->line('btn_submit_text');?></span>
                        <img src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt="">
                    </button>
            	</div>
        	</div>
    	</div>
    </div>
   
<script>
    $("#newWindow").hide();
    $("#guestwindow").show();
    function windowSet(n){
    	$("#window_id").parsley().reset();
        $("#window_name").parsley().reset();
        if(n=='new'){
            $("#newWindow").show();
            $("#guestwindow").hide();
            $("#window_name").attr('data-parsley-required',true);
            $("#window_id").removeAttr('data-parsley-required');
        }else if(n=='same'){
            $("#newWindow").hide();
            $("#guestwindow").show();
            $("#window_id").attr('data-parsley-required',true);
            $("#window_name").removeAttr('data-parsley-required');
        }
    }
</script>
<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script type="text/javascript">
	
function submitBtn() {
	var id="b_service_frm";
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
					swal(resp.msg);
					setTimeout(function() {
						location.href=resp.returnurl;
					}, 1000);
				}else{
					swal("error",resp.msg);
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