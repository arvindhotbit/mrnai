<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <?php foreach ($breadcrumbs as  $breadcrumb) { ?>
                <li class="<?php echo $breadcrumb['class'];?>"> 
                    <?php if(!empty($breadcrumb['link'])) { ?>
                        <a href="<?php echo $breadcrumb['link'];?>"><?php echo $breadcrumb['icon'].$breadcrumb['title'];?></a>
                    <?php } else {
                        echo $breadcrumb['icon'].$breadcrumb['title'];
                    } ?>
                </li>
            <?php }?> 
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-lg-12">
              <form class="" id="change_password" method="POST" enctype="multipart/form-data"  action="<?php echo current_url(); ?>" role="form" data-parsley-validate>
        		<div class="col-lg-6">
                   <h3><?php if(isset($page_title)) echo $page_title; ?></h3>
    	        	<div class="box box-primary">
    	            	<!-- /.box-header -->
    	            	<div class="box-body">
    	                	<div class="row">
                                <div class="panel-body">
                                    <?php echo form_error('username'); ?>
                                    <?php echo form_error('email'); ?>
                                    <?php if ($this->session->flashdata('error')) { ?>
                                    <div class="alert alert-block alert-danger fade in">
                                        <button data-dismiss="alert" class="close" type="button">×</button>
                                        <?php echo $this->session->flashdata('error') ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($this->session->flashdata('success')) { ?>
                                        <div class="alert alert-block alert-success fade in">
                                            <button data-dismiss="alert" class="close" type="button">×</button>
                                            <?php echo $this->session->flashdata('success') ?>
                                        </div>
                                    <?php } ?>
                                    <!-- ajax error msg -->
                                    <div id= 'notification_msg'> </div>
                                        <div class="box-body">
                                             <div class="form-group">
                                                <label for="country">Role</label>
                                                <select data-parsley-required data-parsley-required-message="Please Select Role." class="form-control" id="role_id" name="role_id">
                                                    <option value="" >Select Role</option>
                                                    <?php if(!empty($role_list)){   
                                                    foreach ($role_list as $list) {  
                                                    ?>
                                                    <option value="<?php echo $list['role_id'];?>" ><?php echo $list['name'];?></option>
                                                    <?php }}?> 
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="fullname" >Full Name *</label>
                                                <input type="text" class="form-control" maxlength="50"  oninput="this.value = this.value.replace(/[^A-Za-z0-9-'()& ]/g,'');" name="fullname" id="fullname" value="<?php if(isset($admin_data['fullname'])) echo $admin_data['fullname']; ?>" data-parsley-maxlength="50"  placeholder="Full Name" data-parsley-pattern="^[a-z A-Z 0-9 ]+$" data-parsley-pattern-message="please enter vaild full name." data-parsley-required data-parsley-required-message="Please enter full name.">
                                                <?php echo form_error('fullname'); ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="username">Username *</label>
                                                <input type="text"  class="form-control" id="username" name="username" placeholder="Username"   onkeyup="this.value = this.value.replace(/[^A-Za-z0-9-_.']/g,'');"   value="<?php if(isset($admin_data['username'])) echo $admin_data['username']; ?>" data-parsley-minlength="6" data-parsley-maxlength="12" data-parsley-required data-parsley-required-message="Please enter username." data-parsley-minlength-message="Username must be at least 6 characters long." data-parsley-maxlength-message="Username must be at most 12 characters long.">
                                                <p class="error" id="un_error" style="display:none;">Username already used.</p>
                                               
                                            </div>
          
                                            <div class="form-group">
                                                <label for="email">Email *</label>
                                                <input type="text" class="form-control" id="email"  maxlength="50" data-parsley-maxlength="50" name="email" placeholder="Email" value="<?php if(isset($admin_data['email'])) echo $admin_data['email']; ?>" data-parsley-required data-parsley-required-message="Please enter email." data-parsley-type="email" data-parsley-type-message="Please enter valid email." >
                                                <p class="error" id="email_error" style="display:none;">Email already used.</p>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile">Mobile *</label>
                                                <input type="text" class="form-control" id="mobile" maxlength="10" name="mobile" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Mobile" value="<?php if(!empty($admin_data['mobile'])) echo $admin_data['mobile']; ?>" 
                                                data-parsley-required data-parsley-required-message="Please enter mobile number." 
                                                data-parsley-type="number" 
                                                data-parsley-minlength="10" 
                                                data-parsley-minlength-message="Mobile number must be at least 10 digits long." 
                                                data-parsley-maxlength-message="Mobile number must be at most 10 digits long."
                                                data-parsley-maxlength="10" 
                                                data-parsley-type-message="Please enter valid mobile number" >
                                                <?php echo form_error('mobile'); ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Password *</label>
                                                <input type="password" class="form-control"  id="password" name="password" placeholder="Password" value="<?php if(isset($admin_data['password'])) echo $admin_data['password']; ?>" 
                                             
                                                 maxlength="50" 
                                                 data-parsley-required data-parsley-required-message="Please enter password." 
                                                 data-parsley-minlength="6" 
                                                 data-parsley-maxlength="50" 
                                                 data-parsley-maxlength-message="Password must be at maximum 50 digits long." 
                                                 data-parsley-minlength-message="Password must be at least minimum 6 digits long." >
                                               
                                                <?php echo form_error('password'); ?>
                                            </div>

                                             <div class="form-group">
                                                <label for="confirm_password">Confirm Password *</label>
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" 
                                                 maxlength="50" 
                                                 data-parsley-required data-parsley-required-message="Please enter confirm password." 
                                                 data-parsley-minlength="6" 
                                                 data-parsley-maxlength="50" 
                                                 data-parsley-maxlength-message="Confirm password must be at maximum 50 digits long." 
                                                 data-parsley-minlength-message="Confirm password must be at least minimum 6 digits long."
                                                 data-parsley-equalto="#password" data-parsley-equalto-message="The Confirm Password field does not match the Password field.">
                                                <?php echo form_error('confirm_password'); ?> 
                                            </div>

                                            
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                   <textarea class="form-control" data-parsley-maxlength-message="Address must be maximum 300 characters long." 
                                                data-parsley-maxlength="300"   maxlength="300"  id="address" name="address" placeholder="Address"><?php if(!empty($admin_data['address'])) echo $admin_data['address']; ?></textarea>
                                                <?php echo form_error('address'); ?>
                                            </div>

                                            <div class="form-group">
                                            <label class="">Image </label>
                                           
                                                <div data-provides="fileupload" class="fileupload fileupload-new"><input type="hidden">
                                                    <div style="width: 150px; height: 120px;" class="fileupload-new thumbnail">
                                                        
                                                    </div>
                                                    <div style="max-width: 150px; line-height: 5px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                                    <div>
                                                        <span class="btn btn-file"><span class="fileupload-new btn btn-default">Select image</span>
                                                        <span class="fileupload-exists">Change</span>
                                                        <input id="user_profile_pic" type="file" name="image" class="default" accept="image/*">
                                                        <?php /*<input id="user_profile_pic" type="file" name="image" class="default" accept="image/*" data-parsley-required data-parsley-required-message="Please upload image." data-parsley-errors-container='#image_error'>*/?>
                                                        </span>
                                                        <a data-dismiss="fileupload" class="btn fileupload-exists error v-align-middle" href="#">Remove</a>
                                                        <div id="eeror_image" style="color: red;"></div>
                                                    </div>
                                                    <div id="image_error" class="error"></div>
                                                    <?php echo isset($upload_error)?$upload_error:'';?>
                                                </div>
                                            <!-- </div> -->
                                        </div>
                                           
                                    </div>
                                   
                                </div><!-- panel body-->
                            </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <a href="admin/subadmin/list" class="btn btn-default">Back</a>
                                </div>
                            </div>
                        </div>    
                      
                        </div>
                    </div><!-- row-->

                </div><!-- col-6-->
              </form>
        </div>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>

var error_msg ='';
var error_msg1 ='';
//check username 
$('#username').change(function(e) {
    var id = "A"; 
    var username = $("#username").val();
    
    if(id!='') {
        $.ajax({
            type:'POST',
            url: "<?php echo base_url(); ?>admin/ajax/check_username/",
            data: {id:id,username:username},
            
            success:function(data)
            {
                 if(data==1) {
                    error_msg = "Username already used." ;
                    $("#un_error").show();
                } else{
                    error_msg = "" ;
                    $("#un_error").hide();
                }
            }
        });
    }
});

//check email 
$('#email').change(function(e) {
    var id = "A"; 
    var email = $("#email").val();
    
    if(id!='') {

        $.ajax({
            type:'POST',
            url: "<?php echo base_url(); ?>admin/ajax/check_admin_email/",
            data: {id:id,email:email},
            
            success:function(data)
            {
                if(data==1) {
                    error_msg1 = "Email already used." ;
                    $("#email_error").show();
                }else{
                    error_msg1 = "" ;
                    $("#email_error").hide();
                }
            }
        });
    }
});
    
$(document).ready(function(){
    $("form").submit(function(){
      
        if(error_msg !=''){
            return false;
        }
         if(error_msg1 !=''){
            return false;
        }
    });
});


$("#user_profile_pic").change(function() {

    var val = $(this).val();

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'jpg': case 'png':  case 'jpeg':
           $("#eeror_image").html('');
            break;
        default:
            $(this).val('');
            // error message here
              $("#eeror_image").html('Only images are allowed to upload');
            break;
    }
});


</script>



















