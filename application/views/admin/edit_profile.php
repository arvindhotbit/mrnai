<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <h1><?php if(isset($page_title)) echo $page_title; ?></h1>
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
                <div class="col-lg-6">
                    <div class="box box-primary">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="panel-body">
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

                                    <form class="" id="change_password" method="POST" action="<?php echo base_url("admin/edit_profile"); ?>" role="form" data-parsley-validate>
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="fullname" >Full Name *</label>
                                                <input type="text" class="form-control " data-parsley-maxlength="50"  data-parsley-pattern="^[a-z A-Z 0-9 ]+$"  maxlength="50"  name="fullname" id="fullname"  value="<?php if(isset($admin_data['fullname'])) echo $admin_data['fullname']; ?>" placeholder="Full Name" data-parsley-pattern-message="please enter vaild full name." data-parsley-required data-parsley-required-message="Please enter full name.">
                                                <?php echo form_error('fullname'); ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="username">Username *</label>
                                                <input type="text"  class="form-control" id="username" name="username" data-parsley-required data-parsley-type="alphanum" placeholder="Username" value="<?php if(isset($admin_data['username'])) echo $admin_data['username']; ?>" data-parsley-minlength="6" data-parsley-maxlength="12" data-parsley-required data-parsley-required-message="Please enter username." data-parsley-minlength-message="Username must be at least 6 characters long." data-parsley-maxlength-message="Username must be at most 12 characters long."  oninput="check_username_value();">
                                                <p class="error" id="un_error" style="display:none;">Username already used.</p>
                                                <?php echo form_error('username'); ?>
                                            </div>
          
                                            <div class="form-group">
                                                <label for="email">Email *</label>
                                                <input type="text" class="form-control" id="email"  name="email" placeholder="Email"  value="<?php if(isset($admin_data['email'])) echo $admin_data['email']; ?>" data-parsley-required data-parsley-required-message="Please enter valid email." data-parsley-type="email" data-parsley-type-message="Please enter valid email." oninput="check_email_value();">
                                                <p class="error" id="email_error" style="display:none;">Email already used.</p>
                                                <?php echo form_error('email'); ?>
                                            </div>

                                            <div class="form-group">
                                                <label for="mobile">Mobile *</label>
                                                <input type="text" class="form-control" id="mobile" name="mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Mobile" value="<?php if(!empty($admin_data['mobile'])) echo $admin_data['mobile']; ?>" 
                                                 data-parsley-required data-parsley-required-message="Please enter mobile number." 
                                                data-parsley-type="number" 
                                                data-parsley-minlength="10" 
                                                data-parsley-minlength-message="Mobile number must be at least 10 digits long." 
                                                data-parsley-maxlength-message="Mobile number must be at most 12 digits long." 
                                                data-parsley-maxlength="12" 
                                                data-parsley-type-message="Please enter valid mobile number"

                                                > 
                                                <?php echo form_error('mobile'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                  <textarea class="form-control" data-parsley-maxlength-message="Address must be maximum 300 characters long." 
                                                data-parsley-maxlength="300"   maxlength="300"  id="address" name="address" placeholder="Address"><?php if(!empty($admin_data['address'])) echo $admin_data['address']; ?></textarea>

                                                <?php echo form_error('address'); ?>

                                            </div>
                                            
                                            <div class="box-footer">
                                                <div class="form-group">
                                                    <div class="col-md-12 text-center">
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                        <a href="admin/dashboard" class="btn btn-default">Back</a>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </form>
                                </div><!-- panel body-->
                            </div>
                        </div>
                    </div><!-- row-->
                </div><!-- col-6-->

                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-body">
                            <form class="form-horizontal">
                                <div class="col-md-6 text-center">
                                    <input type="hidden" id="admin_id" name="admin_id" value="<?php echo $admin_data['admin_id']; ?>" />
                                    <div class="control-group">
                                        <div class="box-body">
                                            <label class="">Profile Image *</label>
                                            <div class="controls">
                                                <div data-provides="fileupload" class="fileupload fileupload-new">
                                                    <div class="fileupload-new thumbnail" style="width: auto;max-width: 150px;">
                                                    <?php if(!empty($admin_data['profile_pic'])){ ?>
                                                        <img alt="No Image" src="<?php echo !empty($admin_data['profile_pic'])?base_url().$admin_data['profile_pic']:'';?>" style="width: auto;">
                                                        <?php } ?>
                                                    </div>
                                                    
                                                    <div style="max-width: 150px; max-height: 150px; line-height: 5px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                                    <div>
                                                        <span class="btn btn-file">
                                                            <span class="fileupload-new btn btn-default">Change Image</span>
                                                                <span class="btn fileupload-exists">Change</span>
                                                                <input type="file" name="image" id="image" class="default user_profile_pic" accept="image/*">
                                                            </span>
                                                            <a data-dismiss="fileupload" class="btn remove fileupload-exists" href="#">Remove</a>
                                                         <div id="eeror_image" style="color: red;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"></div>
                                    <div class="form-group"></div>
                                    <div class="form-group"></div>
                                    <div class="form-group">
                                        <div class="col-md-4">
                                         <button type="button" id="img_upload_button" class="btn btn-info upload_profile_pic">Upload</button>
                                        </div>
                                    </div>
                                    <div class="form-group" >
                                        <div class="col-sm-8">
                                            <div class="progress">
                                            <div class="progress-bar" role="progressbar" id="progressBar_image" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" id="status_image"></div>
                                        
                                    </div>
                                </div>
                                <div class="col-sm-12 text-center" id="error" style="color: red;"></div>
                                <div class="col-sm-12 text-green text-center" id="success"></div>
                            </form>
                  
                        </div><!-- panel body-->
                    </div>
                </div><!-- col-12-->
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
var error_msg ='';
//check username 
// $('#username').change(function(e) {
//     var id = "<?php echo $admin_data['admin_id']; ?>"; 
//     var username = $("#username").val();
//     if(id!='') {
//         $.ajax({
//             type:'POST',
//             url: "<?php echo base_url(); ?>admin/ajax/check_username/",
//             data: {id:id,username:username},
            
//             success:function(data)
//             {
//                  if(data==1) {
//                     error_msg = "Username already used." ;
//                     $("#un_error").show();
//                 }
//             }
//         });
//     }
// });

function check_username_value(){
    var id = "<?php echo $admin_data['admin_id']; ?>"; 
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
                }else{
                    error_msg = "" ;
                    $("#un_error").hide();
                }
            }
        });
    }
}



function check_email_value(){
    var id = "<?php echo $admin_data['admin_id']; ?>"; 
    var email = $("#email").val();

    if(id!='') {

        $.ajax({
            type:'POST',
            url: "<?php echo base_url(); ?>admin/ajax/check_admin_email/",
            data: {id:id,email:email},
            
            success:function(data)
            {
                if(data==1) {
                    error_msg = "Email already used." ;
                    $("#email_error").show();
                 } else{
                    error_msg = "" ;
                    $("#email_error").hide();
                }
            }
        });
    }
}

// //check email 
// $('#email').change(function(e) {
//     var id = "<?php echo $admin_data['admin_id']; ?>"; 
//     var email = $("#email").val();
//     if(id!='') {

//         $.ajax({
//             type:'POST',
//             url: "<?php echo base_url(); ?>admin/ajax/check_admin_email/",
//             data: {id:id,email:email},
            
//             success:function(data)
//             {
//                 if(data==1) {
//                     error_msg = "Email already used." ;
//                     $("#email_error").show();
//                  } else{
//                     error_msg = "" ;
//                     $("#email_error").hide();
//                 }
//             }
//         });
//     }
// });
    
</script>

<script>
$(document).ready(function(){
    $("form").submit(function(){
      
        if(error_msg!=''){
            return false;
        }
    });
});

$(".user_profile_pic").change(function() {
    $('#success').html('');
    var val = $(this).val();
    if(val!=''){
    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'jpg': case 'png':  case 'jpeg':
           $("#error").html('');
            break;
        default:
            $(this).val('');
            // error message here
             $("#error").html('Only jpg, jpeg, png files are allowed to upload.');
            break;
    }
    }
});
</script>

















