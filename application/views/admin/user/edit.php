<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> <?php echo $page_title;?> </h1>
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
        <div class="box box-primary"> 
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">  
                    <div class="col-lg-6">
                        <!-- flash messages-->
                        <div class="message_box" style="display:none;"></div>
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
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                 <div class="nav-tabs-custom">
                                    <?php if(isset($form_action) && !empty($form_action)){ ?>
                                    <form id="edit_user_form" class="" method="POST" action="" enctype="multipart/form-data" role="form"  data-parsley-validate>
                                    <?php } ?>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label for="fullname">Name *</label>
                                                    <input type="text" class="form-control" id="fullname"  name="fullname" placeholder="Name" value="<?php if(!empty($users['fullname']))echo $users['fullname']; ?>" 
                                                    data-parsley-required data-parsley-required-message="Please enter name." maxlength="100">
                                                    <?php echo form_error('name'); ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email *</label>
                                                    <input type="text" class="form-control" id="email"  name="email" placeholder="Email" value="<?php if(!empty($users['email']))echo $users['email']; ?>" 
                                                    data-parsley-required data-parsley-required-message="Please enter email." data-parsley-type="email" data-parsley-type-message="Please enter valid email." maxlength="100">
                                                    <?php echo form_error('email'); ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mobile">Phone Number </label>
                                                    <input type="text" class="form-control" id="phone_no"  name="phone_no" oninput="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Phone Number" value="<?php if(!empty($users['phone_no']))echo $users['phone_no']; ?>"  
                                                    data-parsley-type="number" data-parsley-minlength="10" 
                                                    maxlength="10" 
                                                    data-parsley-type-message="Please enter valid phone number" data-parsley-minlength-message="Please enter valid number">
                                                    <?php echo form_error('phone_no'); ?>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address </label>
                                                    <input type="text" class="form-control" id="address"  name="address" placeholder="Address" value="<?php if(!empty($users['address']))echo $users['address']; ?>"  maxlength="250">
                                                    <?php echo form_error('address'); ?>
                                                </div>

                                            </div>
                                           
                                            <div class="box-footer text-left">
                                                <?php if(isset($form_action) && !empty($form_action)){ ?>
                                                    <button type="submit" id="submit_form" class="btn btn-primary" onclick="return form_submit('edit_user_form');">Update</button>
                                                <?php } ?>
                                                <a href="<?php echo $back_action;?>" class="btn btn-default">Back</a> 
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.box --> 
            </div><!-- col-12--> 
        </div><!-- row--> 
    </section>
</div>


<script type="text/javascript">
var is_email_valid=1;

function form_submit(id)
{

    if(is_email_valid==1)
    {
        submitDetailsForm(id);
    }else
    {
         return false;
    }
}


</script>

