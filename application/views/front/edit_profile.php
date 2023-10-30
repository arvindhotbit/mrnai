<body>
	<div class="wrapper">
		<div class="topSection themeClr">
			<div class="container mini-container">
				<div class="row ">
					<div class="col-12  shadow">
						<div class="d-flex bg-white  justify-content-between align-items-center py-2">
							<div class="w-25"><a class="cursor-pointer" href="<?php echo site_url('business_window');?>"><img src="<?php echo site_url();?>assets/front/images/ic_back_dark.svg"
								alt=""></a>
							</div>
							<div class="heading w-50 text-center">
								<h6><?php echo $this->lang->line('lab_your_business_detail_text');?></h6>
							</div>
							<div class="whatBtn w-25"> <a href="#" class="btn btn-outline-success"><img
								src="<?php echo site_url();?>assets/front/images/new/header_whatsapp.svg" alt=""><small><?php echo $this->lang->line('lab_support_text');?></small> </a>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="bottomSection h-100vh  mt-3">
				<div class="container mini-container formSection">
					<div class="row">
						<form method="POST" id="b_edit_frm" action="<?php echo base_url("update_business_profile"); ?>" enctype="multipart/form-data" role="form" data-parsley-validate>
						<div class="col-11 mx-auto">
							<div class="mb-4">
								<label for="logo" class="userpic shadow">
									<?php if(!empty($detail['logo'])){ ?>
									<img id="preview" src="<?php echo $detail['logo'];?>" alt="" class="img-fluid">
									<?php }else{ ?>
									<img id="preview" src="<?php echo site_url();?>assets/front/images/pic.jpg" alt="" class="img-fluid">
									<?php } ?>
								</label>
								<input type="file" class="d-none" name="logo" id="logo" accept="images/*">
							</div>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="<?php echo $this->lang->line('input_business_name_text');?>" name="business_name" value="<?php echo $detail['business_name'];?>" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('input_business_name_req');?>" data-parsley-errors-container="#err_b_name" maxlength="100" />
							</div>
							<span id="err_b_name"></span>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="<?php echo $this->lang->line('input_business_ownname_text');?>" name="fullname" value="<?php echo $detail['fullname'];?>" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('input_business_ownname_req');?>" data-parsley-errors-container="#err_f_name" maxlength="60"/>
							</div>
							<span id="err_f_name"></span>
							<div class="mb-3">
								<input type="text" class="form-control" name="phone_no" placeholder="<?php echo $this->lang->line('input_business_mobile_text');?>" value="<?php echo $detail['phone_no'];?>" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" maxlength="10" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('input_business_mobile_req');?>" data-parsley-errors-container="#err_mobile_no" readonly/>
							</div>
							<span id="err_mobile_no"></span>
							<div class="mb-3">
								<select name="country_id" id="" class="form-control" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('input_business_mobile_req');?>" data-parsley-errors-container="#err_country" onchange="getState(this.value)">
									<option value=""><?php echo $this->lang->line('lab_country_text');?></option>
									<?php foreach ($country as $value) { ?>
										<option value="<?php echo $value['id'];?>" <?php echo ($value['id']==$detail['country_id'])?'selected':'';?>><?php echo $value['name'];?></option>
									<?php } ?>
								</select>
							</div>
							<span id="err_country"></span>
							<div class="mb-3">
								<select name="state_id" id="state_id" class="form-control" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('err_state_select');?>" data-parsley-errors-container="#err_state" onchange="getCity(this.value)">
									<option value=""><?php echo $this->lang->line('lab_state_text');?></option>
									<?php if(!empty($states)) { ?>
									<?php foreach ($states as $value) { ?>
										<option value="<?php echo $value['id'];?>" <?php echo ($value['id']==$detail['state_id'])?'selected':'';?>><?php echo $value['name'];?></option>
									<?php }} ?>

								</select>
							</div>
							<span id="err_state"></span>
							<div class="mb-3">
								<select name="city_id" id="city_id" class="form-control" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('err_city_select');?>" data-parsley-errors-container="#err_city">
									<option value=""><?php echo $this->lang->line('lab_city_text');?></option>
									<?php if(!empty($cities)) { ?>
									<?php foreach ($cities as $value) { ?>
										<option value="<?php echo $value['id'];?>" <?php echo ($value['id']==$detail['city_id'])?'selected':'';?>><?php echo $value['name'];?></option>
									<?php }} ?>
								</select>
							</div>
							<span id="err_city"></span>
							<div class="mb-3">
								<input type="text" class="form-control google_address" placeholder="<?php echo $this->lang->line('lab_address_text');?>" value="<?php echo $detail['address'];?>" name="address" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('err_address_input');?>" data-parsley-errors-container="#err_addres" maxlength="150" />
								<input type="hidden" name="lat_val" id="lat_val" value="<?php echo $detail['lat'];?>">
								<input type="hidden" name="long_val" id="long_val" value="<?php echo $detail['long'];?>">
							</div>
							<span id="err_addres"></span>
							<div class="mb-3">
								<select name="category_id" id="" class="form-control" data-parsley-required data-parsley-required-message="<?php echo $this->lang->line('err_business_type_select');?>" data-parsley-errors-container="#err_category">
									<option value=""><?php echo $this->lang->line('lab_business_type_text');?></option>
									<?php foreach ($categories as $value) { ?>
										<option value="<?php echo $value['id'];?>" <?php echo ($value['id']==$detail['category_id'])?'selected':'';?>><?php echo $value['name'];?></option>
									<?php } ?>
								</select>
							</div>
							<span id="err_category"></span>
							<div class="mb-3">
								<button class="btn shadow mb-3 bg-orange w-100 d-flex justify-content-between" onclick="submitBtn()" id="b_edit_frm_btn">
									<span></span><span class="text-white"><?php echo $this->lang->line('btn_update_text');?></span>
									<img src="<?php echo site_url();?>assets/front/images/btn_arrow.svg" alt="">
								</button>
							</div>
						</div>
						</form>
					</div>

				</div>
			</div>

		</div>
	</div>

<script src="<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?libraries=places&key=<?php echo PLACES_API_KEY;?>&sensor=false"></script>
<script type="text/javascript">
var options = {
    componentRestrictions: {
        country: 'in'
    }
};
var autocomplete = new google.maps.places.Autocomplete(document.getElementsByClassName('google_address')[0], options);
google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();
    var lat = place.geometry.location.lat();
    var long = place.geometry.location.lng();
    // console.log(lat+'=='+long)
    // console.log(place)
    // console.log(place.formatted_address);
    $('#lat_val').val(lat);
    $('#long_val').val(long);
});

function submitBtn() {
	var id="b_edit_frm";
  var form_action=$("#"+id).attr('action');
  $("#"+id).parsley().validate();
  var form = $('#'+id)[0];
  if($("#"+id).parsley().isValid()){
  	var lt=$('#lat_val').val();
  	if(lt==''){
  		swal("error",'Please select correct address location.');
  	}else{
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
	        // $("html, body").animate({ scrollTop: 0 }, "slow");
	        $("#"+id+"_btn").attr('disabled',false);
	        if(resp.status==1){
	          swal(resp.msg);
	          $("#"+id).parsley().reset();
	          $("#"+id)[0].reset();
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
  }
  return false;
}


function getState(country_id) {
	$("#state_id").empty();
	$("#city_id").empty();
	$("#city_id").append(`<option value=''><?php echo $this->lang->line('lab_city_text');?></option>`);
	if(country_id==''){
		$("#state_id").append(`<option value=''><?php echo $this->lang->line('lab_state_text');?></option>`);
		return;
	}
	var id="b_edit_frm";
    $("#loader").show(); 
    $("#"+id+"_btn").attr('disabled',true);
    $.ajax({
		url: "<?php echo site_url('get-state');?>",
		type: 'POST',
		data: {country_id:country_id},
		dataType: 'json',
		success:function(resp){
			$("#loader").hide();  
			$("#"+id+"_btn").attr('disabled',false);
			if(resp.status==1){
			  	$("#state_id").append(`<option value=''><?php echo $this->lang->line('lab_state_text');?></option>`);
			  	for (var i = 0; i < resp.list.length; i++) {
			  		$("#state_id").append("<option value='"+resp.list[i].id+"'>"+resp.list[i].name+"</option>");
			  	}
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
function getCity(state_id) {
	$("#city_id").empty();
	if(state_id==''){
		$("#city_id").append(`<option value=''><?php echo $this->lang->line('lab_city_text');?></option>`);
		return;
	}
	var id="b_edit_frm";
    $("#loader").show(); 
    $("#"+id+"_btn").attr('disabled',true);
    $.ajax({
		url: "<?php echo site_url('get-city');?>",
		type: 'POST',
		data: {state_id:state_id},
		dataType: 'json',
		success:function(resp){
			$("#loader").hide();  
			$("#"+id+"_btn").attr('disabled',false);
			if(resp.status==1){
			  	$("#city_id").append(`<option value=''><?php echo $this->lang->line('lab_city_text');?></option>`);
			  	for (var i = 0; i < resp.list.length; i++) {
			  		$("#city_id").append("<option value='"+resp.list[i].id+"'>"+resp.list[i].name+"</option>");
			  	}
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

var logprev="<?php echo site_url();?>assets/front/images/pic.jpg";
$('#logo').on("change", previewImages);
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


