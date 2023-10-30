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
        <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-6  col-lg-offset-3">
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
                                <form class="" id="change_password" method="POST" action="<?php echo base_url("admin/change_password"); ?>" role="form" data-parsley-validate>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="old_password">Old Password *</label>
                                            <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Old Password"  data-parsley-required data-parsley-required-message="Please enter old password.">
                                            <?php echo form_error('old_password'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password" >New Password*</label>
                                             <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password"
                                                 data-parsley-required data-parsley-required-message="Please enter new password."
                                                data-parsley-minlength="6" 
                                                maxlength="15" 
                                                data-parsley-number="1"
                                                data-parsley-minlength-message="Password must be atleast minimum 6 digits long.">
                                            <?php echo form_error('new_password'); ?>
                                        </div>
              
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password *</label>
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" maxlength="15"
                                                data-parsley-required data-parsley-required-message="Please enter confirm password." 
                                                data-parsley-equalto="#new_password" data-parsley-equalto-message="The Confirm Password field does not match the Password field.">
                                            <?php echo form_error('confirm_password'); ?>
                                        </div>

                                        <div class="box-footer text-center">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="admin/dashboard" class="btn btn-default">Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- panel body-->
                        </div><!-- end panel -->
                    </div><!-- col-6-->
                </div><!-- row-->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->









