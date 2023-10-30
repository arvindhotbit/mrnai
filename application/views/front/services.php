<body>
    <div class="wrapper h-100vh">
    	<div class="topSection themeClr">
    		<div class="container mini-container">
           		<div class="row ">
            		<div class="col-12 g-0 shadow">
                		<div class="d-flex bg-white bg-default justify-content-between align-items-center py-2">
                    		<div><a href="<?php echo $back_link;?>">
                    			<img src="<?php echo site_url();?>assets/front/images/ic_back_dark.svg" alt=""></a>
                    		</div>
                    		<div class="heading"><h6><?php echo $this->lang->line('lab_select_service_text');?></h6></div>
                    		<div><a href="#" class="invisible"><img src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt=""></a></div>
                		</div>
            		</div>
           		</div>
        	</div>
    	</div>
    	<div class="bottomSection mh-auto mb-2">
        	<div class="container mini-container">
            	<div class="row">
                	<div class="col-12">
                      	<div class="d-flex align-items-center themeTitle togglebtn py-2">
                        	<h4 class="mb-0 me-2"><?php echo $this->lang->line('lab_show_female_service_text');?></h4>
                        	<div class="form-check form-switch">
                            	<input type="checkbox" id="offcanvas-toggler" class="form-check-input" onclick="filter()" <?php echo ($is_female=='yes')?'checked':'';?>/>
                        	</div> 
                      	</div>
                      	<?php if($services) {?>
                      	<?php foreach ($services as $key => $value) { ?>
                    	<label class="card mb-2 shadow r-10 cursor-pointer" for="s2<?php echo $key;?>">
                        	<div class="card-body p-0 searchList servicelist">
                            	<div class="d-flex ">
                                	<div class="caption ">
                                    	<div class="d-flex p-1 px-2 border-bottom w-100 align-items-center justify-content-between">
                                        	<h4 class="mb-0"><?php echo ucfirst($value['service_name']);?></h4>
                                        	<a  class="flex-row-reverse">
                                        		<?php if($value['gender']=='female'){ ?>
                                       			<img class="img-fluid" src="<?php echo site_url();?>assets/front/images/ic_female.svg" alt="">
                                       			<?php }else{ ?>
                                       			<img class="img-fluid" src="<?php echo site_url();?>assets/front/images/ic_male.svg" alt="">
                                        		<?php } ?>
                                        	</a>
                                    	</div>
                                    	<div class="d-flex p-1 px-2 w-100 align-items-center justify-content-between timingslots">
                                        	<div class="mb-0 d-flex flex-column"><span><?php echo $this->lang->line('lab_take_time_text');?></span>  <span><?php echo $value['service_time_str'];?></span> </div>
                                        	<div class="mb-0 d-flex flex-column"><span><?php echo $this->lang->line('lab_serve_text');?></span>  <span><?php echo ucfirst($value['service_person']);?></span> </div>
                                        	<div class="plusbtn shadow">
                                            	<input type="checkbox" id="s2<?php echo $key;?>" class="d-none serviceschk" value="<?php echo $value['id'];?>">
                                            	<label for="s2<?php echo $key;?>"> 
                                                <img class="img-fluid plus" src="<?php echo site_url();?>assets/front/images/new/checkbox_a.svg" alt="">
                                                <img class="img-fluid check" src="<?php echo site_url();?>assets/front/images/ic_right.svg" alt="">
                                            	</label>
                                            </div>
                                    	</div>
                                	</div>
                           	 	</div>
                        	</div>
                    	</label>
                    	<?php } }else{ ?>
                    		<?php echo $this->lang->line('info_no_service_text');?>
                    	<?php } ?>
                    </div>
                </div>
            </div>
    	</div>
		<div class="container">
			<div class="row">
	    		<div class="col-12">
	        		<button data-bs-toggle="offcanvas" data-bs-target="#bookingform" class="btn shadow  bg-orange w-100 d-flex justify-content-between">
	        		<span></span><span class="text-white"><?php echo $this->lang->line('btn_continue_text');?></span>
	        		<img src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt="">
		        	</button>
		    	</div>
			</div>
		</div>
    
    <!-- user detail input form -->
   	<div class="offcanvas offcanvas-bottom _setLocation _h45" id="bookingform">
   		<form method="POST" id="u_input_frm" action="<?php echo base_url("user_book_table"); ?>" enctype="multipart/form-data" role="form" data-parsley-validate>
	    	<div class="offcanvas-header ">
	      		<h1 class="offcanvas-title"><?php echo $this->lang->line('head_your_detail_title');?></h1>
	      		<!-- <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button> -->
	    	</div>
	    	<div class="offcanvas-body py-1">
	      		<div class="mb-4">
	        		<label for="userPic" class="userpic ">
	            		<img id="preview" src="<?php echo site_url();?>assets/front/images/pic.jpg" alt="" class="img-fluid">
	        		</label>
	        		<input type="file" class="d-none" id="userPic" name="profile_pic" accept="images/*" capture>
	      		</div>
		     	<div class="mb-3">
		     		<input type="hidden" name="window_id" value="<?php echo $window['id'];?>">
		     		<input type="hidden" name="business_id" value="<?php echo $detail['id'];?>">
		     		<input type="hidden" name="device_token" id="device_token" value="">
		        	<input type="text" name="username" id="username" placeholder="<?php echo $this->lang->line('input_name_text');?>" class="form-control" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('err_name_text');?>" data-parsley-errors-container="#err_user_name" maxlength="100">
		     	</div>
		     	<span id="err_user_name"></span>
		     	<div class="mb-3">
	        		<input type="text" name="mobile_no" id="mobile_no" placeholder="<?php echo $this->lang->line('input_mobile_text');?>" class="form-control" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="10">
	     		</div>
	      		<a class="btn orangeBtn shadow" href="javascript:void(0);" onclick="submitBtn()" id="u_input_frm_btn">
	        		<span></span>
	        		<h4 class="mb-0"><?php echo $this->lang->line('btn_show_me_no_text');?></h4>
	        		<img class="position-absolute right-8"  src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt="">
	    		</a>
	    	</div>
    	</form>
  	</div>
 </div>

<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script type="text/javascript">
	// closeCanvas
function filter(){
	var param="<?php echo ($is_female=='yes')?'':'?female=yes';?>";
	var url="<?php echo $current_link;?>"+param;
	window.location.href=url;
}
if(localStorage.getItem("openseatuser")){
	var openseatuser=localStorage.getItem("openseatuser");
	openseatuser=openseatuser.split("||");
	$('#device_token').val(openseatuser[0]);
	$('#username').val(openseatuser[1]);
	$('#mobile_no').val(openseatuser[2]);
	if(openseatuser[3]){
		$('#preview').attr('src',openseatuser[3]);
	}
}
function submitBtn() {

	var services=[];
	$(".serviceschk").each(function(){
		if($(this).prop('checked')){
			services.push($(this).val());
		}
	});
	if(services.length==0){
		swal(`<?php echo $this->lang->line('err_service_select_text');?>`);
		return false;
	}
	var id="u_input_frm";
	var form_action=$("#"+id).attr('action');
	$("#"+id).parsley().validate();
	var form = $('#'+id)[0];
	if($("#"+id).parsley().isValid()){
	    var formData = new FormData(form);
	    formData.append('services',services);
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
					localStorage.setItem("openseatuser",resp.userdata);
					swal(resp.msg);
					$("#"+id).parsley().reset();
					$("#"+id)[0].reset();
					setTimeout(function() {
						location.href=resp.returnurl;
					}, 1500);
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

var logprev="<?php echo site_url();?>assets/front/images/pic.jpg";
$('#userPic').on("change", previewImages);
function previewImages() {

  // var $preview = $('#preview').empty();
  $('#preview').attr('src',logprev);
  if (this.files) $.each(this.files, readAndPreview);

  function readAndPreview(i, file) {
    if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
      return alert(file.name +" is not an image");
    } // else...
    
    var reader = new FileReader();

    $(reader).on("load", function() {
    	$('#preview').attr('src',this.result);
      // $preview.append($("<img/>", {src:this.result, height:100,width:100}));
    });

    reader.readAsDataURL(file);
    
  }
}
</script>